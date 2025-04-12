@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Create Student</h2>
        </div>
        <div class="col-md-6 text-end">
            <a class="btn btn-secondary btn-sm" href="{{ route('students.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <!-- Display Validation Errors -->
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

    <!-- Student Creation Form -->
    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label"><strong>Name:</strong></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Student Name" required>
        </div>

        <div class="mb-3">
            <label for="rollno" class="form-label"><strong>Roll No:</strong></label>
            <input type="text" name="rollno" id="rollno" class="form-control" value="{{ old('rollno') }}" placeholder="Roll Number" required>
        </div>

        <div class="mb-3">
            <label for="department_id" class="form-label"><strong>Department:</strong></label>
            <select name="department_id" id="department_id" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-floppy-disk"></i> Save Student
            </button>
        </div>
    </form>
</div>
@endsection
