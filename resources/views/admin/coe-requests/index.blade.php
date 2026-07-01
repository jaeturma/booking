@extends('adminlte::page')

@section('title', 'COE Requests')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Certificate of Employment (COE) Requests</h3>
    </div>
    <div class="card-body">
        <table id="coeRequestsTable" class="table table-sm table-striped table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Booking Code</th>
                    <th>Name</th>
                    <th>Employee No.</th>
                    <th>District</th>
                    <th>School/Office</th>
                    <th>Purpose</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    <th>Action</th>
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
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function () {
    $('#coeRequestsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.coe-requests.data") }}',
        columns: [
            { data: 'booking_code',    name: 'booking_code' },
            { data: 'employee_name',   name: 'employee_name' },
            { data: 'employee_no',     name: 'employee_no',     orderable: false },
            { data: 'district',        name: 'district',        orderable: false },
            { data: 'school_office',   name: 'school_office',   orderable: false },
            { data: 'purpose',         name: 'purpose' },
            { data: 'created_at',      name: 'created_at' },
            { data: 'status',          name: 'status',          orderable: false, searchable: false },
            { data: 'actions',         name: 'actions',         orderable: false, searchable: false },
        ],
        order: [[6, 'desc']],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
        responsive: true,
        stateSave: true,
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>rt<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
});
</script>
@stop
