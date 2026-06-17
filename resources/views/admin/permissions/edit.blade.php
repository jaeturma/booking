@extends('adminlte::page')

@section('title', 'Edit Permission')

@section('content_header')
    <h1>Edit Permission</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Permission Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
