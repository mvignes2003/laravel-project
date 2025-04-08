<!-- resources/views/departments/index.blade.php -->
@extends('layouts.app')

@section('content')
<center> <h1>Departments</h1>

    <!-- Add Department Button -->
    <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
    <form action="{{ route('departments.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
   <br> <button type="submit" class="btn btn-primary" >Import Departments</button>
        <input type="file" name="file" accept=".xlsx,.csv" required>

    <a href="{{ route('departments.export') }}" class="btn btn-success" diaplay="inline">Export Departments</a>

</form></center>
  
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('import_errors') && count(session('import_errors')) > 0)
    <ul class="alert alert-danger">
        @foreach(session('import_errors') as $error)
            <li>
                <strong>Row {{ $error['row'] }}:</strong> {{ $error['error'] }}
                <ul>
                    <li><strong>Data:</strong> {{ implode(', ', $error['data']->toArray()) }}</li>
                </ul>
            </li>
        @endforeach
    </ul>
    {{-- Clear the session after displaying errors --}}
    {{ session()->forget('import_errors') }}
@endif



    <!-- Import and Export Buttons -->

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->description }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" display="inline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
