@extends('adminlte::page')

@section('title', 'Booking Transactions')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Booking Transactions</h3>
    </div>
    <div class="card-body">
        <table id="transactionsTable" class="table table-sm table-striped table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Code</th>
                    <th>Client</th>
                    <th>Service / Office</th>
                    <th>Date/Time</th>
                    <th>Status</th>
                    @can('manage-transactions')<th>Actions</th>@endcan
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert2.all.min.js') }}"></script>

<script>
$(document).ready(function () {
    const dt = $('#transactionsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.transactions.data") }}',
        columns: [
            { data: 'booking_code',   name: 'booking_code' },
            { data: 'client',         name: 'client',        orderable: false },
            { data: 'service_office', name: 'service_office',orderable: false, searchable: false },
            { data: 'created_at',     name: 'created_at' },
            { data: 'status',         name: 'status',        orderable: false, searchable: false },
            @can('manage-transactions')
            { data: 'actions',        name: 'actions',       orderable: false, searchable: false },
            @endcan
        ],
        order: [[3, 'desc']],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
        responsive: true,
        stateSave: true,
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>rt<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function postAction(url) {
        const res = await fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            credentials: 'same-origin',
        });
        const data = await res.json().catch(() => ({}));
        if (!res.ok) throw new Error(data.message || 'Request failed');
        return data;
    }

    $(document).on('click', '.js-validate', async function () {
        const btn = this;
        const { isConfirmed } = await Swal.fire({
            title: 'Validate this booking?',
            text: 'Booking: ' + btn.dataset.code,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, validate',
        });
        if (!isConfirmed) return;
        try {
            await postAction(btn.dataset.action);
            await Swal.fire('Validated!', '', 'success');
            dt.ajax.reload(null, false);
        } catch (err) {
            Swal.fire('Error', err.message, 'error');
        }
    });

    $(document).on('click', '.js-hide', async function () {
        const btn = this;
        const { isConfirmed } = await Swal.fire({
            title: 'Hide this booking?',
            text: 'Hidden bookings are invisible to office users.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hide',
        });
        if (!isConfirmed) return;
        try {
            await postAction(btn.dataset.action);
            await Swal.fire('Hidden', '', 'success');
            dt.ajax.reload(null, false);
        } catch (err) {
            Swal.fire('Error', err.message, 'error');
        }
    });

    $(document).on('click', '.js-unhide', async function () {
        const btn = this;
        const { isConfirmed } = await Swal.fire({
            title: 'Unhide this booking?',
            showCancelButton: true,
            confirmButtonText: 'Unhide',
        });
        if (!isConfirmed) return;
        try {
            await postAction(btn.dataset.action);
            await Swal.fire('Visible', '', 'success');
            dt.ajax.reload(null, false);
        } catch (err) {
            Swal.fire('Error', err.message, 'error');
        }
    });
});
</script>
@stop
