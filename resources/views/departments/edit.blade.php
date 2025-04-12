@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2>Edit Department</h2>
        <a class="btn btn-primary btn-sm" href="{{ route('departments.index') }}">
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

<!-- Department Edit Form -->
<form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label"><strong>Department Name:</strong></label>
        <input type="text" name="name" id="name" class="form-control" 
               value="{{ old('name', $department->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label"><strong>Description:</strong></label>
        <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $department->description) }}</textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-floppy-disk"></i> Update
        </button>
    </div>
</form>
@endsection
