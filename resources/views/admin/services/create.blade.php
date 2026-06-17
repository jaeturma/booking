@extends('adminlte::page')

@section('title', 'Create Service')

@section('content_header')
    <h1>Create Service</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="office_id">Office</label>
                <select name="office_id" class="form-control" required>
                    <option value="">-- Select Office --</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
                @error('office_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="sub_services">Sub-services</label>
                <textarea name="sub_services" class="form-control" rows="5" placeholder="One sub-service per line">{{ old('sub_services') }}</textarea>
                <small class="text-muted">Use this for services like Other requests/inquiries.</small>
                @error('sub_services') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
