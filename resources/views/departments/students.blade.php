
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Students in {{ $department->name }} Department</h4>
        <a href="{{ url()->previous() }}" class="btn btn-info">← Back</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Roll No</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($department->students as $student)
                <tr>
                    <td>{{ $student->rollno }}</td>
                    <td>{{ $student->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
