@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Permissions</h3>
        <div class="card-tools">
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Permission
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="permissionsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Permission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $i => $permission)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $permission->name }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                              style="display:inline;" class="ml-1">
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

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    $('#permissionsTable').DataTable({
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
        responsive: true,
        columnDefs: [{ targets: [-1], orderable: false }],
    });
});
</script>
@stop
