@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Services</h3>
        @can('manage-offices-services')
        <div class="card-tools">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Service
            </a>
        </div>
        @endcan
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="servicesTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Office</th>
                    <th>Sub-services</th>
                    @can('manage-offices-services')<th>Actions</th>@endcan
                </tr>
            </thead>
            <tbody>
                @foreach($services as $i => $service)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->office->name ?? '-' }}</td>
                    <td>
                        @forelse($service->subServices as $subService)
                            <span class="badge badge-info">{{ $subService->name }}</span>
                        @empty
                            <span class="text-muted">-</span>
                        @endforelse
                    </td>
                    @can('manage-offices-services')
                    <td class="text-nowrap">
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                              style="display:inline;" class="ml-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endcan
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
    $('#servicesTable').DataTable({
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
        responsive: true,
        @can('manage-offices-services')
        columnDefs: [{ targets: [-1], orderable: false }],
        @endcan
    });
});
</script>
@stop
