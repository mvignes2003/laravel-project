@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Student Details</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <!-- Student Details Table -->
    <table class="table table-bordered mt-3">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td>{{ $student->rollno }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $student->department->name ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Edit</a>
        </div>
        <div class="col-md-6 text-end">
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection
