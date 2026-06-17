@extends('adminlte::page')

@section('title', 'Edit Office')

@section('content_header')
    <h1>Edit Office</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.offices.update', $office->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Office Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $office->name) }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="main">Main</label>
                <input type="text" name="main" class="form-control" value="{{ old('main', $office->main) }}">
                @error('main') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="district">District</label>
                <input type="text" name="district" class="form-control" value="{{ old('district', $office->district) }}">
                @error('district') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="show_order">Show Order</label>
                <input type="number" name="show_order" class="form-control" value="{{ old('show_order', $office->show_order) }}" required>
                @error('show_order') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.offices.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
