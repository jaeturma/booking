@extends('adminlte::page')

@section('title', 'Services Management')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Service
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
                    <th>Name</th>
                    <th>Office</th>
                    <th>Sub-services</th>
                    <th width="150px">Actions</th>
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
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
