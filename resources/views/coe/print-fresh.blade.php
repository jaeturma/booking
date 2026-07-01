@php
  $caSettings = $caSettings ?? \App\Models\AppSetting::caSettings();
  $caThemeColor = $caSettings['ca_theme_color'] ?? '#000000';
  $qrText = "Name: " . ($certificate->employee_name ?? '') . "\n"
          . "Position: " . ($certificate->position ?? '') . "\n"
          . "Office/Station: " . ($certificate->school_office ?? '') . "\n"
          . "Certificate of Employment\n"
          . "COE Number: " . $certificate->certificate_number;
@endphp
<!DOCTYPE html>
<html>
<head>
  <title>Certificate of Employment</title>
  <link href="{{ asset('vendor/jsdelivr/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      font-family: "Times New Roman", serif;
    }
    .certificate {
      width: 100%;
      max-width: 795px; /* ~A4 width at 72dpi */
      margin: auto;
      padding: 40px 60px 2in;
      border: 2px solid {{ $caThemeColor }};
      min-height: 10in; /* fits one A4 page with print margins */
      position: relative;
      box-sizing: border-box;
      font-size: 1rem;
      line-height: 1.5;
      background-color: #fff;
    }
    .logo {
      height: 70px;
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
      font-size: 16pt;
      font-weight: bold;
      letter-spacing: 1px;
      color: {{ $caThemeColor }};
    }
    .certificate-number {
      font-size: 10pt;
      margin-top: 3px;
      color: {{ $caThemeColor }};
    }
    .body-text {
      margin-top: 50px;
      font-size: 1.05rem;
    }
    .body-text .twtmc {
      text-align: center;
      font-weight: bold;
      margin-bottom: 25px;
      letter-spacing: .5px;
    }
    .body-text p {
      text-align: justify;
      text-indent: 45px;
      margin-bottom: 22px;
    }
    .signature {
      margin-top: 70px;
      text-align: center;
    }
    .signature strong {
      color: {{ $caThemeColor }};
    }
    .qr-code {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 1.5in;
      height: 1.5in;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .qr-code svg, .qr-code img {
      width: 100%;
      height: 100%;
    }
    @media print {
      .no-print { display: none; }
      body { margin: 0; }
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
        <h4 class="biggest">CERTIFICATE OF EMPLOYMENT</h4>
        <h6 class="certificate-number">Control No. : {{ $certificate->certificate_number }}</h6>
      </div>
      <img src="{{ asset('images/ddo_logo.png') }}" class="logo" alt="Right Logo">
    </div>

    <!-- Body -->
    <div class="body-text">
      <p class="twtmc">TO WHOM IT MAY CONCERN:</p>

      <p>
        This is to certify that <strong>{{ strtoupper($certificate->employee_name ?? '') }}</strong>@if($certificate->position), {{ $certificate->position }},@endif
        is a bona fide employee of <strong>{{ $certificate->school_office ?? '—' }}</strong>@if($certificate->district), {{ $certificate->district }} District,@endif
        Schools Division of Davao de Oro, Department of Education.
      </p>

      <p>
        This certification is issued upon the request of the above-named employee
        @if($certificate->purpose)
          for <strong>{{ $certificate->purpose }}</strong> purposes.
        @else
          for whatever legal purpose(s) it may serve.
        @endif
      </p>

      <p>
        Issued this {{ $certificate->issued_at->format('F d, Y') }} at the Schools Division Office of Davao de Oro,
        Capitol Complex, Cabidianan, Nabunturan, Davao de Oro, Philippines.
      </p>
    </div>

    <!-- Signature -->
    <div class="signature">
      <p><strong>{{ $caSettings['ca_signatory_name'] }}</strong></br>
      {{ $caSettings['ca_signatory_position'] }}</p>
    </div>

    <!-- QR Code (Name, Position, Office/Station, COE Number) -->
    <div class="qr-code">
      {!! QrCode::size(144)->generate($qrText) !!}
    </div>
  </div>

  <!-- Back button -->
  <div class="no-print text-center mt-3">
    <a href="{{ route('admin.coe-requests.index') }}" class="btn btn-secondary">Back</a>
  </div>
</body>
</html>
