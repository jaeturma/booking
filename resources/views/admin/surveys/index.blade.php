@extends('adminlte::page')

@section('title', 'Survey Responses')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <div class="d-flex flex-wrap align-items-center">
            <h3 class="card-title mb-0 mr-auto">Survey Responses</h3>
            <select id="filterYear" class="form-control form-control-sm mr-2 mb-1" style="width:auto" title="Filter by year">
                <option value="">All Years</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <input type="date" id="filterFrom" class="form-control form-control-sm mr-2 mb-1" style="width:auto" title="From date">
            <input type="date" id="filterTo" class="form-control form-control-sm mr-2 mb-1" style="width:auto" title="To date">
            <a href="{{ route('admin.surveys.export') }}" id="exportExcelBtn" class="btn btn-sm btn-success mb-1">
                <i class="fas fa-file-excel mr-1"></i> Export to Excel
            </a>
        </div>
    </div>
    <div class="card-body">
        <table id="surveysTable" class="table table-sm table-striped table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Office</th>
                    <th>Service</th>
                    <th>Client</th>
                    <th>Demographics</th>
                    <th>Responses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

{{-- Responses Detail Modal --}}
<div class="modal fade" id="responsesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Survey Detail</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="responsesModalBody">
                <div class="text-center py-4">
                    <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    const exportBaseUrl = '{{ route("admin.surveys.export") }}';

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function (ch) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[ch];
        });
    }

    const table = $('#surveysTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.surveys.data") }}',
            data: function (d) {
                d.from = $('#filterFrom').val();
                d.to   = $('#filterTo').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex',    name: 'DT_RowIndex',   orderable: false, searchable: false },
            { data: 'created_at',     name: 'created_at' },
            { data: 'office_name',    name: 'office_name',   orderable: false },
            { data: 'service_name',   name: 'service_name',  orderable: false },
            { data: 'client',         name: 'client',        orderable: false },
            { data: 'demographics',   name: 'demographics',  orderable: false, searchable: false },
            { data: 'response_count', name: 'response_count',orderable: false, searchable: false, className: 'text-center' },
            { data: 'actions',        name: 'actions',       orderable: false, searchable: false },
        ],
        order: [[1, 'desc']],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
        responsive: true,
    });

    function applyFilter() {
        const from = $('#filterFrom').val();
        const to   = $('#filterTo').val();
        const params = new URLSearchParams();
        if (from) params.set('from', from);
        if (to)   params.set('to', to);
        const qs = params.toString();
        $('#exportExcelBtn').attr('href', exportBaseUrl + (qs ? '?' + qs : ''));
        table.ajax.reload();
    }

    $('#filterYear').on('change', function () {
        const year = $(this).val();
        $('#filterFrom').val(year ? year + '-01-01' : '');
        $('#filterTo').val(year ? year + '-12-31' : '');
        applyFilter();
    });

    $('#filterFrom, #filterTo').on('change', function () {
        $('#filterYear').val('');
        applyFilter();
    });

    $(document).on('click', '.js-view-responses', function () {
        const url = $(this).data('url');
        $('#responsesModalBody').html(
            '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>'
        );
        $('#responsesModal').modal('show');

        $.getJSON(url, function (data) {
            const s = data.survey;
            let html = `
                <div class="row mb-3">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless mb-0">
                            <tr><th class="w-50">Booking Code</th><td>${s.booking_code}</td></tr>
                            <tr><th>Date</th><td>${s.date}</td></tr>
                            <tr><th>Office</th><td>${s.office}</td></tr>
                            <tr><th>Service</th><td>${s.service}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless mb-0">
                            <tr><th class="w-50">Employee No.</th><td>${s.employee_no}</td></tr>
                            <tr><th>Type</th><td>${s.customer_type}</td></tr>
                            <tr><th>Age / Gender</th><td>${s.age} / ${s.gender}</td></tr>
                            <tr><th>Requested COA</th><td>${s.requested_coa}</td></tr>
                        </table>
                    </div>
                </div>
                <table class="table table-sm table-borderless mb-0">
                    <tr><th style="width:25%">Remarks</th><td>${escapeHtml(s.remarks)}</td></tr>
                </table>
                <hr>
                <h6 class="font-weight-bold mb-2">Responses</h6>`;

            if (data.responses.length === 0) {
                html += '<p class="text-muted">No responses recorded.</p>';
            } else {
                html += '<table class="table table-sm table-bordered">'
                     + '<thead class="thead-light"><tr><th>#</th><th>Question</th><th>Answer</th></tr></thead><tbody>';
                data.responses.forEach(function (r, i) {
                    html += `<tr><td>${i + 1}</td><td>${r.question}</td><td><span class="badge badge-info">${r.answer}</span></td></tr>`;
                });
                html += '</tbody></table>';
            }

            $('#responsesModalBody').html(html);
        }).fail(function () {
            $('#responsesModalBody').html('<div class="alert alert-danger">Failed to load responses.</div>');
        });
    });
});
</script>
@stop
