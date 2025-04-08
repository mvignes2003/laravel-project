<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepartmentExport;
use App\Imports\DepartmentImport;



class DepartmentController extends Controller
{
    // Display all departments
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    // Show form to create new department
    public function create()
    {
        return view('departments.create');
    }

    // Store new department
    public function store(Request $request)
    {
        // Validation rules and custom error messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments,name', 
            'description' => 'nullable|string|max:1000', // Optional description with a max length
        ], [
            'name.required' => 'The department name is required.',
            'name.unique' => 'This department already exists.',
            'description.string' => 'The description must be a valid string.',
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create department after successful validation
        Department::create([
            'name' => $request->input('name'),
            'description' => $request->input('description', '') // Default empty string if no description
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    // Show single department details
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    // Show edit form for department
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update department details
    public function update(Request $request, Department $department)
    {
        // Validation rules and custom error messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id, // Ignore current department ID during update
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'The department name is required.',
            'name.unique' => 'This department name already exists.',
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update department data after validation
        $department->update([
            'name' => $request->input('name'),
            'description' => $request->input('description', ''), // Default empty string if no description
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    // Delete a department
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }

    // Export department data to Excel
   /* public function export()
    {
        return Excel::download(new DepartmentExport, 'departments.xlsx');
        
    }*/
    public function export()
    {
        // Flash success message
       
    
        // Export the data
        session()->flash('success', 'Exported successfully!');

        // Trigger the download of the Excel file
        return Excel::download(new DepartmentExport, 'departments.xlsx');
        // session()->flash('success', 'Exported successfully!');
    
        // Redirect to another page (e.g., the list of departments or the current page)
        // return redirect()->route('departments.index')->with('success', 'Exported successfully!');
    }
    
    
    // Import departments from Excel
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'department_file' => 'required|mimes:xlsx,csv|max:10240', // Only allow .xlsx or .csv files, max size 10MB
        ]);
    
        // Create an instance of the DepartmentImport class
        $import = new DepartmentImport();
    
        try {
            // Attempt to import the file
            $import->import($request->file('department_file'));
    
            // Check for any import errors from the session
            $errors = session()->get('import_errors', []);
    
            // If there are errors, flash them to the session
            if (!empty($errors)) {
                session()->flash('error', 'There were some issues with your import.');
                session()->flash('import_errors', $errors);
            } else {
                // Flash success message if no errors
                session()->flash('success', 'Departments imported successfully!');
            }
        } catch (\Exception $e) {
            // Handle unexpected errors
            session()->flash('error', 'An error occurred during the import: ' . $e->getMessage());

        }
    
        // Clear import errors from the session after displaying them
    
        // Redirect back to the departments index route
        return redirect()->route('departments.index');

    }
    
    
    public function collection()
    {
        return Department::select('id', 'name', 'description')->get();
    }

    // Headings for Excel export
    public function headings(): array
    {
        return [
            'ID', 
            'Department Name', 
            'Description'
        ];
    }

    // Store imported departments
    public function importStore(Request $request)
    {
        // Validate file type and size
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            // Import departments data
            Excel::import(new DepartmentImport, $request->file('file'));
            return redirect()->back()->with('success', 'Departments imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during import: ' . $e->getMessage());
        }
    }
}
