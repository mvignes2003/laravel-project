@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2>Edit Student</h2>
        <a class="btn btn-primary btn-sm" href="{{ route('students.index') }}">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<!-- Show validation errors if any -->
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Student Edit Form -->
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Student Name -->
    <div class="mb-3">
        <label for="name" class="form-label"><strong>Student Name:</strong></label>
        <input type="text" name="name" id="name" class="form-control" 
               value="{{ old('name', $student->name) }}" required>
    </div>

    <!-- Roll Number -->
    <div class="mb-3">
        <label for="rollno" class="form-label"><strong>Roll Number:</strong></label>
        <input type="text" name="rollno" id="rollno" class="form-control" 
               value="{{ old('rollno', $student->rollno) }}" required>
        @error('rollno')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Department -->
    <div class="mb-3">
        <label for="department_id" class="form-label"><strong>Department:</strong></label>
        <select name="department_id" id="department_id" class="form-control" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" 
                    {{ old('department_id', $student->department_id) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-floppy-disk"></i> Update Student
        </button>
    </div>
</form>
@endsection
