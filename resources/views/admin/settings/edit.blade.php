@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5 class="mb-3">Certificate of Appearance</h5>

            <div class="form-group">
                <label for="ca_signatory_name">CA Signatory Name</label>
                <input type="text" name="ca_signatory_name" id="ca_signatory_name" class="form-control"
                    value="{{ old('ca_signatory_name', $settings['ca_signatory_name']) }}" required>
                @error('ca_signatory_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="ca_signatory_position">Position</label>
                <input type="text" name="ca_signatory_position" id="ca_signatory_position" class="form-control"
                    value="{{ old('ca_signatory_position', $settings['ca_signatory_position']) }}" required>
                @error('ca_signatory_position') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="ca_esign">E-Sign</label>
                <input type="file" name="ca_esign" id="ca_esign" class="form-control" accept="image/*">
                @error('ca_esign') <small class="text-danger">{{ $message }}</small> @enderror
                @if(!empty($settings['ca_esign_path']))
                    <div class="mt-2">
                        <img src="{{ asset($settings['ca_esign_path']) }}" alt="E-Sign" style="max-height:80px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="ca_pnpki">PNPKI</label>
                <input type="file" name="ca_pnpki" id="ca_pnpki" class="form-control" accept="image/*">
                @error('ca_pnpki') <small class="text-danger">{{ $message }}</small> @enderror
                @if(!empty($settings['ca_pnpki_path']))
                    <div class="mt-2">
                        <img src="{{ asset($settings['ca_pnpki_path']) }}" alt="PNPKI" style="max-height:80px;">
                    </div>
                @endif
            </div>

            <hr>
            <h5 class="mb-3">Appearance</h5>

            <div class="form-group">
                <label for="ca_background">Background Image</label>
                <input type="file" name="ca_background" id="ca_background" class="form-control" accept="image/*">
                @error('ca_background') <small class="text-danger">{{ $message }}</small> @enderror
                @if(!empty($settings['ca_background_path']))
                    <div class="mt-2">
                        <img src="{{ asset($settings['ca_background_path']) }}" alt="Background" style="max-height:120px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="ca_theme_color">Color Theme</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="color" name="ca_theme_color" id="ca_theme_color" class="form-control"
                        value="{{ old('ca_theme_color', $settings['ca_theme_color']) }}" style="max-width:90px;">
                    <span class="text-muted">{{ old('ca_theme_color', $settings['ca_theme_color']) }}</span>
                </div>
                @error('ca_theme_color') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </form>
    </div>
</div>
@stop
