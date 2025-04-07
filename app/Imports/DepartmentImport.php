<?php
namespace App\Imports;

use App\Models\Department; // Assuming you have a Department model
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Throwable;  // Import Throwable

class DepartmentImport implements ToModel, SkipsOnError
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        // Check if the department already exists by name (adjust according to your fields)
        $existingDepartment = Department::where('name', $row[0])->first(); // Assuming the department name is in the first column

        if ($existingDepartment) {
            // Skip this row and continue processing others
            throw new \Exception("Department Name: '{$row[0]}' already exists.");
        }

        // If the department doesn't exist, create a new one
        return new Department([
            'name' => $row[0],  // Assuming the name is in the first column, adjust as needed
            'description' => $row[1],  // Example, adjust to your columns
        ]);
    }

    public function onError(Throwable $e)  // Accept Throwable, not just Exception
    {
        // Handle the error gracefully if the department already exists
        // You can return the error message from here
        // This will be used by the SkipsOnError trait
        return $e->getMessage();
    }
}
