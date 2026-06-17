@extends('adminlte::page')

@section('title', 'Offices Management')

@section('content_header')
    <h1>Offices</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.offices.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Office
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
                    <th>Main</th>
                    <th>District</th>
                    <th>Show Order</th>
                    <th width="150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offices as $i => $office)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $office->name }}</td>
                    <td>{{ $office->main ?? '-' }}</td>
                    <td>{{ $office->district ?? '-' }}</td>
                    <td>{{ $office->show_order }}</td>
                    <td>
                        <a href="{{ route('admin.offices.edit', $office->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.offices.destroy', $office->id) }}" method="POST" style="display:inline;">
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
