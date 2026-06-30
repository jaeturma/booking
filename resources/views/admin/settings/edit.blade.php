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

            <hr>
            <h5 class="mb-1">Kiosk Screensaver</h5>
            <p class="text-muted small mb-3">
                Videos play in sequence when the kiosk is idle. Supports YouTube links <em>and</em> files stored directly on the kiosk drive —
                enter the full Windows path (e.g. <code>D:\videos\clip1.mp4</code>). The file is read by the kiosk browser, not uploaded to the server.
                Toggle the switch to enable or disable each slot. Use <strong>Test</strong> to preview.
            </p>

            @foreach([1,2,3,4,5] as $n)
            @php
                $ssUrl     = old('screensaver_video_' . $n, $settings['screensaver_video_' . $n] ?? '');
                $ssEnabled = old('screensaver_video_' . $n . '_enabled', $settings['screensaver_video_' . $n . '_enabled'] ?? '1');
            @endphp
            <div class="card mb-2">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        {{-- Enable toggle --}}
                        <div class="form-check form-switch mb-0 flex-shrink-0" title="Enable/disable this slot">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   name="screensaver_video_{{ $n }}_enabled"
                                   id="ss_enabled_{{ $n }}"
                                   value="1"
                                   {{ $ssEnabled === '1' || $ssEnabled === true ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="ss_enabled_{{ $n }}">
                                Video&nbsp;{{ $n }}
                            </label>
                        </div>

                        {{-- URL / path input --}}
                        <input type="text"
                               name="screensaver_video_{{ $n }}"
                               id="screensaver_video_{{ $n }}"
                               class="form-control form-control-sm flex-grow-1"
                               value="{{ $ssUrl }}"
                               placeholder="e.g. D:\videos\clip{{ $n }}.mp4  or  https://youtu.be/...">

                        {{-- Test button --}}
                        <button type="button"
                                class="btn btn-outline-secondary btn-sm flex-shrink-0 ss-test-btn"
                                data-slot="{{ $n }}"
                                title="Preview this video">
                            <i class="fas fa-play me-1"></i>Test
                        </button>
                    </div>
                    @error('screensaver_video_' . $n)
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            @endforeach

            <div class="form-group mt-3" style="max-width:300px;">
                <label for="screensaver_timeout">Idle timeout (seconds)</label>
                <input type="number" name="screensaver_timeout" id="screensaver_timeout" class="form-control"
                    value="{{ old('screensaver_timeout', $settings['screensaver_timeout'] ?? 60) }}"
                    min="10" max="3600" required>
                <small class="text-muted">Screensaver starts after this many seconds of inactivity (minimum 10).</small>
                @error('screensaver_timeout') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </form>
    </div>
</div>

{{-- ===== Screensaver Test Modal ===== --}}
<div class="modal fade" id="ssTestModal" tabindex="-1" aria-labelledby="ssTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header border-secondary py-2">
                <h6 class="modal-title text-white" id="ssTestModalLabel">Screensaver Preview — Video <span id="ssTestSlotLabel"></span></h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" style="min-height:480px;background:#000;position:relative;">
                <div id="ssTestPlayerWrap" style="width:100%;height:480px;position:relative;"></div>
                <p id="ssTestEmpty" class="text-white text-center pt-5" style="display:none;">
                    <i class="fas fa-exclamation-circle fa-2x mb-2 d-block text-warning"></i>
                    No URL entered for this slot.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    function getYouTubeId(url) {
        const m = url.match(/(?:youtube\.com\/watch\?[^#]*v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/);
        return m ? m[1] : null;
    }

    const ssModal    = document.getElementById('ssTestModal');
    const bsModal    = new bootstrap.Modal(ssModal);

    document.querySelectorAll('.ss-test-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const slot  = this.dataset.slot;
            const url   = (document.getElementById('screensaver_video_' + slot)?.value || '').trim();
            const wrap  = document.getElementById('ssTestPlayerWrap');
            const empty = document.getElementById('ssTestEmpty');
            const label = document.getElementById('ssTestSlotLabel');

            label.textContent   = slot;
            wrap.innerHTML      = '';
            empty.style.display = 'none';

            if (!url) {
                empty.style.display = 'block';
                bsModal.show();
                return;
            }

            // Inject and play AFTER the modal is fully visible so browsers allow autoplay
            ssModal.addEventListener('shown.bs.modal', function onShown() {
                ssModal.removeEventListener('shown.bs.modal', onShown);
                const ytId = getYouTubeId(url);
                if (ytId) {
                    const iframe = document.createElement('iframe');
                    iframe.src   = 'https://www.youtube.com/embed/' + ytId + '?autoplay=1&mute=1&controls=1&rel=0&modestbranding=1';
                    iframe.allow = 'autoplay; encrypted-media; fullscreen';
                    iframe.style.cssText = 'width:100%;height:480px;border:0;display:block;';
                    wrap.appendChild(iframe);
                } else {
                    const video = document.createElement('video');
                    video.src            = url;
                    video.controls       = true;
                    video.muted          = true;
                    video.playsInline    = true;
                    video.style.cssText  = 'width:100%;height:480px;object-fit:contain;background:#000;display:block;';
                    wrap.appendChild(video);
                    video.play().catch(() => {});
                }
            });

            bsModal.show();
        });
    });

    // Stop video/iframe when modal closes
    document.getElementById('ssTestModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('ssTestPlayerWrap').innerHTML = '';
    });
})();
</script>
    </div>
</div>
@stop
