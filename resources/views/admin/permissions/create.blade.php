@extends('adminlte::page')

@section('title', 'Create Permission')

@section('content_header')
    <h1>Create New Permission</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Permission Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save
            </button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
