@extends('adminlte::page')

@section('title', 'Survey Responses')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Survey Responses</h3>
        <a href="{{ route('admin.surveys.export') }}" class="btn btn-sm btn-success">
            <i class="fas fa-file-excel mr-1"></i> Export to Excel
        </a>
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
    $('#surveysTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.surveys.data") }}',
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
