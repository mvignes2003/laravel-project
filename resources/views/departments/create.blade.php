@extends('layouts.app')

@section('content')
    <h1>Create New Department</h1>
    
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('departments.create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <button type="submit" class="btn btn-primary">Import Departments</button>
        <input type="file" name="file" accept=".xlsx,.csv" required>

    <a href="{{ route('departments.create') }}" class="btn btn-success" diaplay="inline">Export Departments</a>

</form>


    <!-- Form for creating a new department -->
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Department</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    
@endsection
