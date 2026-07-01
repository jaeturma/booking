@php
  $caSettings = $caSettings ?? \App\Models\AppSetting::caSettings();
  $caThemeColor = $caSettings['ca_theme_color'] ?? '#000000';
  $caBackgroundUrl = !empty($caSettings['ca_background_path']) ? asset($caSettings['ca_background_path']) : null;
  $caEsignUrl = !empty($caSettings['ca_esign_path']) ? asset($caSettings['ca_esign_path']) : asset('images/esign.png');
  $caPnpkiUrl = !empty($caSettings['ca_pnpki_path']) ? asset($caSettings['ca_pnpki_path']) : null;
@endphp
<!DOCTYPE html>
<html>
<head>
  <title>Certificate of Appearance</title>
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
  <link href="{{ asset('vendor/jsdelivr/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      font-family: "Times New Roman", serif;
    }
    .certificate {
    width: 100%;
    max-width: 795px; /* ~A4 width at 72dpi */
    margin: auto;
    padding: 10px 25px;
    border: 2px solid {{ $caThemeColor }};
    min-height: 4.8in;  /* Just under half A4 height */
    position: relative;
    box-sizing: border-box;
    font-size: 0.9rem;  /* Slightly smaller text */
    line-height: 1.3;
    background-color: #fff;
    @if($caBackgroundUrl)
    background-image: url('{{ $caBackgroundUrl }}');
    background-size: cover;
    background-position: center;
    @endif
  }
    .logo {
      height: 65px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header-center {
      text-align: center;
      flex: 1;
      margin: 0 5px;
    }
    .header-center h5,
    .header-center h4,
    .header-center h1,
    .header-center h6 {
      margin: 0;
    }
    .header-center .fs10 {
      font-size: 10pt;
    }
    .header-center .fs11 {
      font-size: 11pt;
    }
    .biggest {
      font-size: 13pt;
      font-weight: bold;
      color: {{ $caThemeColor }};
    }
    .certificate-number {
      font-size: 10pt;
      margin-top: 3px;
      color: {{ $caThemeColor }};
    }
    .info-table dt {
      width: 35%;
      float: left;
      font-weight: bold;
    }
    .info-table dd {
      margin-left: 35%;
    }
    .signature {
      margin-top: 40px;
      text-align: center;
    }
    .qr-code {
      position: absolute;
      bottom: 8px;
      right: 8px;
      width: .7in;
      height: .7in;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .qr-code img {
      max-width: 100%;
      max-height: 100%;
    }
    @media print {
      .no-print { display: none; }
      body { margin: 0; }
    }

    .info-table {
      margin: 0;
      padding: 0;
    }
    .info-table dt {
      margin: 0;
      padding: 0 0 0 50px; /* ← 20px left padding (tab effect) */
      line-height: 1.15;
    }
    .info-table dd {
      font-weight: bold;
      margin: 0 0 0 50px; /* adjust to align values neatly */
      padding: 0;
      line-height: 1.15;
    }
    .signature strong {
      color: {{ $caThemeColor }};
    }
    .esign-img {
      max-height: 80px;
    }
    .pnpki-img {
      max-height: 44px;
      margin-top: 4px;
    }

  </style>
</head>
<body onload="window.print()">
  <div class="certificate">
    <!-- Header with logos and title -->
    <div class="header mb-4">
      <img src="{{ asset('images/deped_logo.png') }}" class="logo" alt="Left Logo">
      <div class="header-center">
        <h6 class="fs10">Republic of the Philippines</h6>
        <h6 class="fs10">DEPARTMENT OF EDUCATION</h6>
        <h6 class="fs10"><strong>Region XI - Davao</strong></h6>
        <h5 class="fs11"><strong>SCHOOLS DIVISION OF DAVAO DE ORO</strong></h5>
        <h6 class="fs10">Nabunturan, Davao de Oro</h6>
        <h4 class="biggest">CERTIFICATE OF APPEARANCE</h4>
        <h6 class="certificate-number">Control No. : {{ $certificate->certificate_number }}</h6>
      </div>
      <img src="{{ asset('images/ddo_logo.png') }}" class="logo" alt="Right Logo">
    </div>

    <!-- Intro sentence -->
    <p class="mt-3 text-justify">
      This is to certify that the employee/officer whose name and designation stated hereunder 
      appeared in this office as indicated in the purpose stated herein:
    </p>

    <!-- Info Table -->
    <dl class="info-table">
      <dt>Name:</dt>
      <dd>{{ $certificate->guest_name }}</dd>

      <dt>Designation:</dt>
      <dd>{{ $certificate->service->name ?? '' }}</dd>

      <dt>Office/School:</dt>
      <dd>{{ $certificate->office->name ?? '' }}</dd>

      <dt>Date/Time:</dt>
      <dd>{{ $certificate->issued_at->format('F d, Y h:i A') }}</dd>

      <dt>Purpose:</dt>
      <dd>{{ $certificate->purpose }}</dd>

      <dt>Remarks:</dt>
      <dd>
        @if($certificate->ob_ot === 'OB')
            Official Business
        @elseif($certificate->ob_ot === 'OT')
            Official Time
        @else
            {{ $certificate->ob_ot ?? '—' }}
        @endif
      </dd>
    </dl>

  </br>
    <!-- Closing sentence -->
    <p class="text-justify">
      Issued this {{ $certificate->issued_at->format('F d, Y') }} at DepEd Schools Division of Davao de Oro office, 
      Capitol Complex, Cabidianan, Nabunturan, Davao de Oro.
    </p>
    <!-- Signature -->
    <div class="signature">
          <p>
            <img src="{{ $caEsignUrl }}" alt="E-Signature" class="esign-img"><br>
            <strong>{{ $caSettings['ca_signatory_name'] }}</strong></br>
          {{ $caSettings['ca_signatory_position'] }}
          @if($caPnpkiUrl)
            <br><img src="{{ $caPnpkiUrl }}" alt="PNPKI" class="pnpki-img">
          @endif
          </p>
        </div>

        <!-- QR Code (Verification URL) -->
        <div class="qr-code">
        <div class="qr-code">
      {!! QrCode::size(100)->generate(url('/certificates/'.$certificate->certificate_number)) !!}
    </div>

    </div>
  </div>

  <!-- Back button -->
  <div class="no-print text-center mt-3">
    <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Back</a>
  </div>
</body>
</html>
