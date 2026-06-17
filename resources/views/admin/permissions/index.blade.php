@extends('adminlte::page')

@section('title', 'Permissions Management')

@section('content_header')
    <h1>Permissions Management</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Permission
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Permission</th>
                    <th width="180px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $i => $permission)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
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
