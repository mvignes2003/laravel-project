@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Department</h1>

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

    <!-- Edit Department Form -->
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Department Name -->
        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $department->name) }}" required>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        </div>       
       
        <!-- Department Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $department->description) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Department</button>
        </div>
    </form>

    <!-- Back Button -->
    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to Departments</a>
</div>
@endsection
