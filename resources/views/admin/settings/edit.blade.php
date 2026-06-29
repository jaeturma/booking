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

            <hr>
            <h5 class="mb-3">Branding / Logos</h5>

            <div class="form-group">
                <label for="kiosk_title">Kiosk Title</label>
                <input type="text" name="kiosk_title" id="kiosk_title" class="form-control"
                    value="{{ old('kiosk_title', $settings['kiosk_title']) }}" required maxlength="100">
                <small class="text-muted">The name displayed in the kiosk header (e.g. "Self-Service Kiosk").</small>
                @error('kiosk_title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="kiosk_footer">Kiosk Footer Text</label>
                <input type="text" name="kiosk_footer" id="kiosk_footer" class="form-control"
                    value="{{ old('kiosk_footer', $settings['kiosk_footer']) }}" maxlength="255">
                <small class="text-muted">Text shown at the bottom of the kiosk (e.g. office name, address, or hotline). Leave blank to hide the footer.</small>
                @error('kiosk_footer') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="login_logo">Login Logo</label>
                <input type="file" name="login_logo" id="login_logo" class="form-control" accept="image/*">
                <small class="text-muted">Displayed on the login, register, and forgot-password pages.</small>
                @error('login_logo') <small class="text-danger">{{ $message }}</small> @enderror
                @if(!empty($settings['login_logo_path']))
                    <div class="mt-2">
                        <img src="{{ asset($settings['login_logo_path']) }}" alt="Login Logo" style="max-height:80px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="app_logo">App Logo</label>
                <input type="file" name="app_logo" id="app_logo" class="form-control" accept="image/*">
                <small class="text-muted">Displayed in the navigation bar across the booking app.</small>
                @error('app_logo') <small class="text-danger">{{ $message }}</small> @enderror
                @if(!empty($settings['app_logo_path']))
                    <div class="mt-2">
                        <img src="{{ asset($settings['app_logo_path']) }}" alt="App Logo" style="max-height:80px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </form>
    </div>
</div>
@stop
