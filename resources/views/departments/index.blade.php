@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Departments</h1>
        </div>
        <div class="col-md-6 text-end">
        @can('department-create')
            <a href="{{ route('departments.create') }}" class="btn btn-success">Add Department</a>
            @endcan
        </div>
    </div>
    @can('department-create')

    <!-- Import/Export Form -->
    <form action="{{ route('departments.import') }}" method="POST" enctype="multipart/form-data" class="mb-3 d-flex align-items-center gap-2">
        @csrf

        <input type="file" name="file" accept=".xlsx,.csv" required class="form-control w-auto">
        <button type="submit" class="btn btn-primary">Import</button>
        <a href="{{ route('departments.export') }}" class="btn btn-success">Export</a>
    </form>
@endcan
    <!-- Session Messages -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('import_errors') && count(session('import_errors')) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach(session('import_errors') as $error)
                    <li>
                        <strong>Row {{ $error['row'] }}:</strong> {{ $error['error'] }}
                        <ul>
                            <li><strong>Data:</strong> {{ implode(', ', $error['data']->toArray()) }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ session()->forget('import_errors') }}
    @elseif(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Departments Table -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>
                
                    <a href="{{ route('departments.show',$department->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i> Show </a>
                   
                    @can('department-edit')
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i> Edit</a>
                        @endcan

                    @can('department-delete')
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                    @endcan

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
