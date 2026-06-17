@extends('adminlte::page')

@section('title', 'Roles Management')

@section('content_header')
    <h1>Roles Management</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Role
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $i => $role)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach($role->permissions as $perm)
                            <span class="badge bg-success">{{ $perm->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
