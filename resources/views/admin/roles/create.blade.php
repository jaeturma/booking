@extends('adminlte::page')

@section('title', 'Create Role')

@section('content_header')
    <h1>Create New Role</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="permissions">Permissions</label>
                <select name="permissions[]" id="permissions" class="form-control select2" multiple required>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}" {{ in_array($permission->name, old('permissions', [])) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
                @error('permissions') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save
            </button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
