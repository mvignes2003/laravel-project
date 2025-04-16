@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            <h2>Students List</h2>
        </div>
        <div class="pull-right">
        @can('student-create')
            <a href="{{ route('students.create') }}" class="btn btn-success">Add Student</a>
            @endcan
        </div>
    </div>

    <!-- Session Messages -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Students Table -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Department</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->rollno }}</td>
                    <td>{{ $student->department->name ?? 'N/A' }}</td>
                    <td>
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">
                    <i class="fa fa-show"></i> Show
                    </a>
                    @can('student-edit')

                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        @endcan

                        @can('student-delete')
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
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
