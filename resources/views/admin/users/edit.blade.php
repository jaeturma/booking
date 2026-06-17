@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="employee_no">Employee No.</label>
                <input type="text" name="employee_no" class="form-control" 
                    value="{{ old('employee_no', $user->employee_no) }}" required>
                @error('employee_no') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password <small class="text-muted">(Leave blank if not changing)</small></label>
                <input type="password" name="password" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <label for="position_id">Position</label>
                <select name="position_id" class="form-control select2" required>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" 
                            {{ old('position_id', $user->position_id) == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                @error('position_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="office_id">Office</label>
                <select name="office_id" class="form-control select2" required>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}" 
                            {{ old('office_id', $user->office_id) == $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
                @error('office_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="roles">Assign Roles</label>
                <select name="roles[]" id="roles" class="form-control select2" multiple required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ in_array($role->name, old('roles', $user->roles->pluck('name')->toArray())) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('roles') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
