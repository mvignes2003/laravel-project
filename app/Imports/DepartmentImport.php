<?php 
namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Throwable;
use Illuminate\Support\Collection;

class DepartmentImport implements ToCollection, SkipsOnError
{
    use Importable, SkipsFailures;

    // This will store error messages for rows that fail
    private $errors = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                // Row index starts from 1 (for user-friendly error reporting)
                
                $rowIndex = $index + 1;

                // Check if the department already exists by name (assuming name is in the first column)
                $existingDepartment = Department::where('name', $row[0])->first();

                if ($existingDepartment) {
                    // If the department already exists, capture the error with row and column details
                    throw new \Exception("Department Name '{$row[0]}' already exists.");
                }

                // If the department doesn't exist, create a new one
                Department::create([
                    'name' => $row[0],  // Assuming the name is in the first column
                    'description' => $row[1],  // Assuming description is in the second column
                ]);
            } catch (\Exception $e) {
                // Handle the error and store the error message in $errors
                $this->handleError($e, $rowIndex, $row);
            }
        }

        // After all rows have been processed, if there are any errors, store them in the session
        if (!empty($this->errors)) {
            session()->put('import_errors', $this->errors);
        }
    }

    // Capture the error message and store it in the $errors array
    private function handleError(Throwable $e, $rowIndex, $row)
    {
        $this->errors[] = [
            'row' => $rowIndex,   // Store the row number for better traceability
            'error' => $e->getMessage(),  // Store the error message
            'data' => $row,       // Store the row data to understand which data failed
        ];
    }

    // Handle errors during import (can be used for additional error handling)
    public function onError(Throwable $e)
    {
        return $e->getMessage(); // Return the error message
    }
}
