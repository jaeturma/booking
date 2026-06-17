@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')
    <h1>Users Management</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
       $(document).ready(function () {
    $('#usersTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true
    });

});

    </script>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add User
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

           <table id="usersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee No.</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Roles</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $user->employee_no }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ is_object($user->position) ? $user->position->name : $user->position }}</td>
                            <td>{{ is_object($user->office) ? $user->office->name : $user->office }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-success">{{ is_object($role) ? $role->name : $role }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info me-1">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="userDetails">Loading...</div>
            </div>
        </div>
    </div>
</div>


@stop
