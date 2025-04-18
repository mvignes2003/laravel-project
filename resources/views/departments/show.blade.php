@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Department</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('departments.index') }}">Back</a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $department->name }}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $department->description }}
        </div>
    </div>
</div>
@endsection
