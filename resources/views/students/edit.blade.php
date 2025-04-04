@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Student</h1>

 <!-- Display validation errors if any 
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    <!-- Edit Student Form -->
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Student Name -->
        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}" required>
        </div>

        <!-- Roll Number -->
        <div class="form-group">
            <label for="rollno">Roll Number</label>
            <input type="text" name="rollno" id="rollno" class="form-control" value="{{ old('rollno', $student->rollno) }}" required>
            @error('rollno')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>

        <!-- Department -->
        <div class="form-group">
        <label for="department_id">Department</label>
        <select name="department_id" id="department_id" class="form-control" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>

    <!-- Back Button -->
    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back to Students</a>
</div>
@endsection