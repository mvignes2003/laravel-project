<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Student;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $departmentCount = Department::count();
        $studentCount = \App\Models\Student::count();
    
        $departments = Department::withCount('students')->get();
    
        // Prepare data for the chart
        $departmentNames = $departments->pluck('name');
        $studentCounts = $departments->pluck('students_count');
    
        return view('reports.index', compact(
            'departmentCount',
            'studentCount',
            'departments',
            'departmentNames',
            'studentCounts'
        ));
    }
}
