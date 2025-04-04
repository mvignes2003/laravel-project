<?php 
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:departments,name', // Ensure the name is unique
            ], [
                'name.required' => 'The department name is required.',
                'name.unique' => 'This department already exists.', // Custom error message
                
               
            ]);
    
            // If validation fails, return back with errors
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // If validation passes, create the department
            Department::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),

            ]);
    
            return redirect()->route('departments.index')->with('success', 'Department created successfully!');
        
        
       
       /* Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully.');
         */               
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

   /* public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments,name', // Ensure the name is unique
        ], [
            'name.required' => 'The department name is required.',
            'name.unique' => 'This department already exists.', // Custom error message
            
           
        ]);

        $department->update($validator);

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully.');
    }*/
    public function update(Request $request, $department)
{
   // Validate the request data
$validator = Validator::make($request->all(), [
    'name' => 'required|string|max:255|unique:departments,name', // Ensure the name is unique
], [
    'name.required' => 'The department name is required.',
    'name.unique' => 'This department already exists.', // Custom error message
]);

// If validation fails, return to the previous page with error messages
if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
}

// Update the department with the validated data
$department->update([
    'name' => $request->input('name'),
]);

// Redirect to the departments index page with success message
return redirect()->route('departments.index')->with('success', 'Department updated successfully!');

}


    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Department deleted successfully.');
    }
    
        
    }
   

