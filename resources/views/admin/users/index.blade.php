@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Users Management</h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
                <button type="button" class="btn btn-success btn-sm ml-1"
                        data-toggle="modal" data-target="#importModal">
                    <i class="fas fa-file-import"></i> Import CSV
                </button>
                <a href="{{ route('admin.users.template') }}" class="btn btn-outline-secondary btn-sm ml-1">
                    <i class="fas fa-download"></i> Template
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('import_summary'))
                <div class="alert alert-{{ session('import_errors') ? 'warning' : 'success' }}">
                    <strong>{{ session('import_summary') }}</strong>
                    @if(session('import_errors'))
                        <ul class="mb-0 mt-2 small">
                            @foreach(session('import_errors') as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

{{-- Import Modal --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-import mr-1"></i> Import Users from CSV
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @error('csv_file')
                        <div class="alert alert-danger py-2">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="csv_file" class="font-weight-bold">CSV File</label>
                        <input type="file" name="csv_file" id="csv_file" accept=".csv,.txt"
                               class="form-control @error('csv_file') is-invalid @enderror" required>
                    </div>

                    <div class="alert alert-info py-2 small mb-0">
                        <strong>Required columns:</strong>
                        <code>employee_no, name, email, password, position, office, role</code><br>
                        <strong>Notes:</strong>
                        <ul class="mb-0 mt-1">
                            <li><code>position</code> and <code>office</code> must match existing names exactly.</li>
                            <li>Use <code>|</code> to assign multiple roles: <em>Validator|Admin</em>.</li>
                            <li><code>password</code> must be at least 6 characters.</li>
                            <li>Rows with errors are skipped; valid rows are still imported.</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.users.template') }}" class="btn btn-outline-secondary mr-auto">
                        <i class="fas fa-download"></i> Download Template
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success ml-1">
                        <i class="fas fa-upload"></i> Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.users.data") }}',
            columns: [
                { data: 'DT_RowIndex',   name: 'DT_RowIndex',   orderable: false, searchable: false },
                { data: 'employee_no',   name: 'employee_no' },
                { data: 'name',          name: 'name' },
                { data: 'position.name', name: 'position.name', defaultContent: '—', searchable: false, orderable: false },
                { data: 'office.name',   name: 'office.name',   defaultContent: '—', searchable: false, orderable: false },
                { data: 'roles',         name: 'roles',         orderable: false, searchable: false },
                { data: 'actions',       name: 'actions',       orderable: false, searchable: false },
            ],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            ordering: true,
            responsive: true,
        });
    });
    </script>
@stop
