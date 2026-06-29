@extends('adminlte::page')

@section('title', 'Offices')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Offices</h3>
        @can('manage-offices-services')
        <div class="card-tools">
            <a href="{{ route('admin.offices.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Office
            </a>
        </div>
        @endcan
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="officesTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Main</th>
                    <th>District</th>
                    <th>Show Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    $('#officesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.offices.data") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name',        name: 'name' },
            { data: 'group',       name: 'group',       defaultContent: '-' },
            { data: 'main',        name: 'main',        defaultContent: '-' },
            { data: 'district',    name: 'district',    defaultContent: '-' },
            { data: 'show_order',  name: 'show_order' },
            { data: 'actions',     name: 'actions',     orderable: false, searchable: false },
        ],
        order: [[4, 'asc']],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
        responsive: true,
    });
});
</script>
@stop
