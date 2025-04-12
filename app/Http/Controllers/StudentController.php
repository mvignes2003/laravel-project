<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class StudentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:student-list|student-create|student-edit|student-delete', ['only' => ['index','store']]);
         $this->middleware('permission:student-create', ['only' => ['create','store']]);
         $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:student-delete', ['only' => ['destroy']]);
    }
    // Display a listing of students
    public function index()
    {
        // Retrieve all students with their associated department
        $students = Student::with('department')->get();

        // Return the index view with the students data
        return view('students.index', compact('students'));
    }

    // Show the form for creating a new student
    public function create()
    {
        // Retrieve all departments to display in the form
        $departments = Department::all();

        // Return the create view with the departments data
        return view('students.create', compact('departments'));
    }

    public function store(Request $request)
{
     // Custom validation for roll number
    $validated = $request->validate([
        'rollno' => 'required|unique:students,rollno',
        'name' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id'

        // Add other fields if necessary
    ], [
        'rollno.unique' => 'This roll number already exists', // Custom error message for the unique validation
    ]);

    // Your code to store the student
    $student = new Student();
    $student->rollno = $request->rollno;
    $student->name = $request->name;
    $student->department_id = $request->department_id;
    $student->save();

    return redirect()->route('students.index')->with('success', 'Student created successfully');
}

    // Show the form for editing the specified student
    public function edit(Student $student)
    {
        // Retrieve all departments to display in the form
        $departments = Department::all();

        // Return the edit view with the student data and departments
        return view('students.edit', compact('student', 'departments'));
    }

    // Update the specified student in the database
    public function update(Request $request, Student $student)
    {
       
$validated = $request->validate([
    'rollno' => [
        'required',
        Rule::unique('students', 'rollno')->ignore($student->id), // Ignore the current student when checking uniqueness
    ],
    'name' => 'required|string|max:255',
    'department_id' => 'required|exists:departments,id',
], [
    'rollno.unique' => 'This roll number already exists for another student', // Custom error message for the unique validation
]);

// Update the student's data
$student->update($validated);

// Redirect to the students index page with success message
return redirect()->route('students.index')->with('success', 'Student updated successfully!');

    }

    // Remove the specified student from the database
    public function destroy(Student $student)
    {
        // Delete the student from the database
        $student->delete();

        // Redirect to the students index page with success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
