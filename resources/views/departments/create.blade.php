@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Create New Department</h2>
    </div>
    <div class="col-md-6 text-end">
        <a class="btn btn-primary btn-sm" href="{{ route('departments.index') }}">
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

<!-- Department Creation Form -->
<form action="{{ route('departments.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label"><strong>Department Name:</strong></label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Department Name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label"><strong>Description:</strong></label>
        <textarea name="description" id="description" class="form-control" placeholder="Department Description" style="height: 150px;" required>{{ old('description') }}</textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-floppy-disk"></i> Submit
        </button>
    </div>
</form>
@endsection
