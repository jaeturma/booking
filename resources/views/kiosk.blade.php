<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Kiosk UI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('vendor/bootswatch/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert2.min.css') }}">

  <script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/qrious/qrious.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert/sweetalert2.all.min.js') }}"></script>


  <style>
    body { background: #f2f2f2; }

    .header { background: #FFD700; box-shadow: 0 4px 10px rgba(0,0,0,.15); }
    .header .brand { display:flex; align-items:center; gap:.6rem; font-weight:700; font-size:1.5rem; }
    .header .brand i { font-size:1.4rem; }
    .btn, .form-control, .modal-content, .card, .progress, .progress-bar { border-radius:0!important; }

    .wrap { max-width:980px; margin:0 auto; padding:20px; }

    @keyframes ss-pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50%       { opacity: 0.65; transform: scale(0.97); }
    }
    #ssTapPrompt { animation: ss-pulse 2s ease-in-out infinite; }
	
	.menu-btn {
	  display: block;
	  width: 100%;
	  padding: 20px;
	  margin: 20px 0;
	  border: 2px solid #999;
	  border-radius: 0;
	  background: #FFD700;
	  cursor: pointer;
	  text-align: left;
	  transition: all 0.2s ease-in-out;
	  box-shadow: 0 3px 6px rgba(0,0,0,0.15);
	}
	.menu-btn:hover {
	  background: #FFC107;
	  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
	}
	.menu-btn.start-disabled,
	.menu-btn.start-disabled:hover {
	  background: #e9ecef;
	  border-color: #bbb;
	  box-shadow: none;
	  color: #777;
	  cursor: not-allowed;
	}
	@keyframes survey-pulse-border {
	  0%, 100% { box-shadow: 0 0 0 0 rgba(255, 160, 0, 0.8), 0 3px 6px rgba(0,0,0,0.15); border-color: #e65c00; }
	  50%       { box-shadow: 0 0 0 10px rgba(255, 160, 0, 0), 0 3px 6px rgba(0,0,0,0.15); border-color: #ff8c00; }
	}
	.menu-btn.start-enabled,
	.menu-btn.start-enabled:hover {
	  background: #FFD700;
	  border-color: #e65c00;
	  border-width: 3px;
	  color: #000;
	  animation: survey-pulse-border 1.4s ease-in-out infinite;
	}

	.menu-header {
	  display: flex;
	  align-items: center;
	  font-weight: bold;
	  font-size: 1.2rem;
	  margin-bottom: 6px;
	}
	.menu-header i {
	  font-size: 1.5rem;
	  margin-right: 10px;
	}

	.menu-btn p {
	  margin: 0;
	  font-size: 0.95rem;
	  color: #222;
	}

  /* Radio: large white, fills solid golden yellow when selected — no center dot */
  .form-check-input.radio-gold {
    width: 2.5rem;
    height: 2.5rem;
    min-width: 2.5rem;
    border: 3px solid #888;
    background-color: #fff !important;
    cursor: pointer;
    transition: background-color .15s ease, border-color .15s ease;
  }
  .form-check-input.radio-gold:checked {
    background-color: #FFD700 !important;
    border-color: #555 !important;
    background-image: none !important;
  }

  /* Pre-question choice buttons (btn-kiosk style with selected state) */
  .cc-radio { display: none; }
  .cc-opt   { display: block; }
  .btn-kiosk-opt {
    width: 100%; padding: 16px 18px; font-size: 1.15rem; font-weight: 700;
    border: 2px solid #ccc; display: flex; align-items: center; gap: 12px;
    background: #FFD700; color: #000; box-shadow: 0 4px 8px rgba(0,0,0,.1);
    cursor: pointer; transition: background .15s, border-color .15s; margin: 0;
  }
  .btn-kiosk-opt:hover { background: #FFC107; }
  .cc-radio:checked + .btn-kiosk-opt {
    background: #FF8C00; color: #fff; border-color: #cc5500;
    box-shadow: 0 4px 14px rgba(204,85,0,.35);
  }

  /* Numeric keypad */
  .num-keypad {
    position: absolute; z-index: 1050; top: 100%; left: 0;
    background: #fff; border: 1px solid #ccc; border-radius: 10px;
    box-shadow: 0 10px 28px rgba(0,0,0,.25); padding: 10px;
    min-width: 220px;
  }
  .keypad-row { display: flex; gap: 6px; margin-bottom: 6px; }
  .keypad-btn {
    flex: 1; padding: 15px 0; font-size: 1.4rem; font-weight: 700;
    border: 1px solid #ddd; border-radius: 8px; background: #f8f9fa;
    cursor: pointer; transition: background .1s; line-height: 1;
  }
  .keypad-btn:hover  { background: #ffe066; }
  .keypad-btn:active { background: #ffd700; }
  .keypad-back { background: #f0f0f0 !important; font-size: 1.2rem !important; }
  .keypad-back:hover { background: #e0e0e0 !important; }
  .keypad-done { background: #28a745 !important; color: #fff; font-size: 1rem !important; font-weight: 700; }
  .keypad-done:hover { background: #218838 !important; }

    .panel { background:#fff; box-shadow:0 8px 18px rgba(0,0,0,.15); padding:24px; margin-top:18px; }
    .step-chips { display:flex; flex-wrap:wrap; gap:8px; align-items:center; }
    .step-chip { background:#e6e6e6; color:#333; padding:6px 12px; font-weight:700; }
    .step-chip.active { background:#FF8C00; color:#fff; }

    .progress { height:14px; margin-top:8px; }
    .progress-bar { transition: width .4s ease, background-color .4s ease; }

    .btn-kiosk { width:100%; padding:16px; font-size:1.15rem; font-weight:700; border:none;
      margin:8px 0; text-align:left; display:flex; align-items:center; gap:10px;
      background:#FFD700; color:#000; box-shadow:0 6px 12px rgba(0,0,0,.12);}
    .btn-kiosk:hover { background:#FFC107; color:#000; }

    .actions { margin-top:10px; }
    .actions .btn { padding:14px; font-weight:700; }
    .form-control { box-shadow:0 3px 6px rgba(0,0,0,.08); }

    .hidden { display:none!important; }

    /* Portrait kiosk: push every modal into the lower touchable zone */
    .modal-dialog-top { margin: 32vh auto 1rem !important; }
    .modal-dialog-centered {
        align-items: flex-start !important;
        padding-top: 30vh !important;
        min-height: unset !important;
    }
    .form-check-input.big-radio {
      width: 3.5rem;
      height: 3.5rem;
      min-width: 3.5rem;
      border: 3px solid #888;
      background-color: #fff !important;
      cursor: pointer;
      transition: background-color .15s ease, border-color .15s ease;
    }
    .form-check-input.big-radio:checked {
      background-color: #FFD700 !important;
      border-color: #555 !important;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23333'/%3e%3c/svg%3e") !important;
    }

    /* Spinner overlay */
    #submitSpinner {
      position: fixed; inset: 0;
      background: rgba(0,0,0,.55);
      z-index: 9999;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
    }
    #submitSpinner .spinner-ring {
      width: 7rem; height: 7rem;
      border: 10px solid rgba(255,255,255,.25);
      border-top-color: #FFD700;
      border-radius: 50%;
      animation: spin .9s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .form-check-label.big-label { font-size: 1.5rem; font-weight: bold; margin-left: 0.5rem; }
      
    /* Thin top progress bar — all network activity */
    #kioskProgress {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 3px;
      z-index: 99999;
      pointer-events: none;
      opacity: 0;
      transition: opacity .2s ease;
    }
    #kioskProgress.active { opacity: 1; }
    #kioskProgress .kp-bar {
      height: 100%;
      width: 0%;
      background: linear-gradient(90deg, #FFD700 0%, #FF6600 60%, #FFD700 100%);
      background-size: 200% 100%;
      box-shadow: 0 0 10px rgba(255,165,0,.9), 0 0 4px #FFD700;
      animation: kp-shimmer 1.6s linear infinite;
    }
    @keyframes kp-shimmer { 0% { background-position: 100% 0; } 100% { background-position: -100% 0; } }

    /* Android-style circular loader inside keypad modal */
    #keypadLoader .android-spinner {
      width: 4rem; height: 4rem;
      border-radius: 50%;
      border: 5px solid #e0e0e0;
      border-top:   5px solid #1a73e8;
      border-right: 5px solid #1a73e8;
      animation: spin .85s cubic-bezier(.4,0,.2,1) infinite;
      margin: 0 auto;
    }
    #keypadLoader .loader-label {
      font-size: 1rem; color: #555; margin-top: .6rem;
    }

    .timeline { position: relative; margin: 20px 0; padding-left: 20px; border-left: 3px solid #ccc; }
    .timeline-item { display: flex; align-items: flex-start; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; position: relative; }
    .timeline-item:last-child { border-bottom: none; }
    .timeline-icon { width: 50px; text-align: center; position: relative; }
    .timeline-icon i { font-size: 1.4rem; color: #555; background: #fff; padding: 2px; border-radius: 50%; z-index: 2; }
    .timeline-item.latest .timeline-icon i { color: #28a745; }
    .timeline-content { flex: 1; padding-left: 10px; }
    .timeline-content h6 { margin: 0 0 6px; font-weight: bold; display: block; }
    .timeline-content p { margin: 0 0 6px; line-height: 1.4; display: block; }
    .timeline-content .small { display: block; color: #666; }

    .booking-details {
      display: grid;
      grid-template-columns: 150px 1fr;
      gap: 6px 15px;
      font-size: 1rem;
      margin-top: 10px;
    }
    .booking-details strong { display: inline-block; min-width: 130px; }

    .office-grid{
      display:grid;
      grid-template-columns: repeat(4, minmax(0,1fr));
      gap:12px;
    }
    .office-grid > .office-btn:nth-child(-n+2){ grid-column: span 2; }

    .office-btn.menu-btn{ margin:0; }
    .office-btn .menu-content hr,
    .office-btn .menu-content p{ display:none; }
    .office-btn .menu-header{ display:flex; align-items:center; }
    .office-btn .menu-header i{ font-size:1.35rem; margin-right:10px; }

    @media (max-width: 768px){
      .office-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
      .office-grid > .office-btn:nth-child(-n+2){ grid-column: span 2; }
    }

    .kiosk-footer {
      background: #FFD700;
      text-align: center;
      padding: 10px 16px;
      font-size: 1rem;
      font-weight: 600;
      color: #222;
      box-shadow: 0 -2px 8px rgba(0,0,0,.1);
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }

  </style>
</head>
<body>

<!-- ===== Screensaver Overlay ===== -->
@php
    $ssMasterEnabled = \App\Models\AppSetting::getValue('screensaver_enabled', '1') === '1';
    $ssMode          = \App\Models\AppSetting::getValue('screensaver_mode', 'video');

    $ssVideos = array_values(array_filter(
        array_map(function ($i) {
            $url     = \App\Models\AppSetting::getValue("screensaver_video_{$i}");
            $enabled = \App\Models\AppSetting::getValue("screensaver_video_{$i}_enabled", '1');
            return ($enabled === '1' && $url !== null && $url !== '') ? $url : null;
        }, [1, 2, 3, 4, 5])
    ));

    $ssImageFolder   = \App\Models\AppSetting::getValue('screensaver_image_folder');
    $ssImageInterval = max(2, (int) \App\Models\AppSetting::getValue('screensaver_image_interval', 8));
    $ssImages = [];

    if ($ssImageFolder) {
        $scanDir = rtrim(str_replace('\\', '/', $ssImageFolder), '/');
        if (!is_dir($scanDir)) {
            $maybe = public_path(ltrim($scanDir, '/'));
            if (is_dir($maybe)) $scanDir = str_replace('\\', '/', $maybe);
        }
        if (is_dir($scanDir)) {
            $exts       = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
            $publicPath = str_replace('\\', '/', public_path());
            $isPublic   = str_starts_with($scanDir, $publicPath);
            $files      = glob($scanDir . '/*') ?: [];
            sort($files);
            foreach ($files as $file) {
                if (!is_file($file)) continue;
                if (!in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $exts, true)) continue;
                $filePath   = str_replace('\\', '/', $file);
                $ssImages[] = $isPublic ? ltrim(str_replace($publicPath, '', $filePath), '/') : $filePath;
            }
        }
    }

    $ssTimeout = max(10, (int) \App\Models\AppSetting::getValue('screensaver_timeout', 60));
@endphp
<div id="screensaverOverlay" style="display:none;position:fixed;inset:0;z-index:9999;background:#000;cursor:pointer;">
    <div id="ssTapPrompt" style="position:absolute;top:0;left:0;width:100%;z-index:10001;padding:22px 20px;text-align:center;background:linear-gradient(to bottom,rgba(0,0,0,.7) 80%,transparent);">
        <span style="color:#FFD700;font-size:2.2rem;font-weight:800;letter-spacing:.08em;text-shadow:0 2px 8px rgba(0,0,0,.8);">
            <i class="bi bi-hand-index-thumb-fill me-2"></i>TAP ANYWHERE TO START THE KIOSK
        </span>
    </div>
    {{-- Player container — filled dynamically with <video> or YouTube iframe --}}
    <div id="ssPlayer" style="position:absolute;inset:0;width:100%;height:100%;"></div>
</div>

<!-- Thin top progress bar (shown on every network request) -->
<div id="kioskProgress"><div class="kp-bar" id="kioskProgressBar"></div></div>

  <!-- Header -->
	<div class="header py-3">
	  <div class="wrap d-flex align-items-center justify-content-between">
		<div class="brand">
		  <i class="bi bi-tablet"></i>
		  <span>{{ \App\Models\AppSetting::getValue('kiosk_title', 'Self-Service Kiosk') }}</span>
		</div>
		<div class="d-flex gap-2">
		  <button id="fullscreenBtn" class="btn btn-outline-dark" onclick="toggleFullscreen()" title="Toggle Fullscreen">
		    <i id="fullscreenIcon" class="bi bi-fullscreen"></i>
		  </button>
		  <button id="homeBtn" class="btn btn-outline-dark">
		    <i class="bi bi-house-fill me-1"></i> Home
		  </button>
		</div>
	  </div>
	</div>
  </br></br></br></br></br>
	<!-- Steps + Progress -->
	<div id="bookingStepsBar" class="wrap hidden mt-2">
	  <div class="panel">
		<div class="step-chips" id="stepChips"></div>
		<div class="progress mt-2">
		  <div id="progressBar" class="progress-bar" role="progressbar" style="width:0%"></div>
		</div>
	  </div>
	</div>

  <div class="wrap">
    <!-- Main Menu -->
    <div id="mainMenu" class="panel text-center">
	  <h3 class="fw-bold mb-4">Welcome! Please choose an option</h3>
	  <button class="menu-btn" onclick="startBooking()">
		<div class="menu-content">
		  <div class="menu-header">
			<i class="bi bi-calendar-check"></i>
			<span>Book Transaction</span>
		  </div>
		  <hr>
		  <p>Create your office transaction easily by booking, ensuring faster processing and avoiding long queues.</p>
		</div>
	  </button>

	  <button class="menu-btn" onclick="startSurvey()">
		<div class="menu-content">
		  <div class="menu-header">
			<i class="bi bi-emoji-smile"></i>
			<span>Client Satisfaction Measurement</span>
		  </div>
		  <hr>
		  <p>The Client Satisfaction (CSM) tracks the customer experience of government offices. Your feedback on your recently concluded transaction will help this office provide better service.</p>
		</div>
	  </button>

	  <button class="menu-btn" onclick="showTracker()">
		<div class="menu-content">
		  <div class="menu-header">
			<i class="bi bi-search"></i>
			<span>Track Document</span>
		  </div>
		  <hr>
		  <p>Track the status of your document in real-time as it moves across different offices.</p>
		</div>
	  </button>

	  <button class="menu-btn" onclick="showCharter()">
		<div class="menu-content">
		  <div class="menu-header">
			<i class="bi bi-file-earmark-text"></i>
			<span>Citizens Charter</span>
		  </div>
		  <hr>
		  <p>View the official Citizens Charter and service standards.</p>
		</div>
	  </button>
    <button class="menu-btn" onclick="showGuide()">
		<div class="menu-content">
		  <div class="menu-header">
			<i class="bi bi-question-circle"></i>
			<span>How to use</span>
		  </div>
		  <hr>
		  <p>Infomercial on how to use this machine</p>
		</div>
	  </button>
	</div>

	<!-- Booking Flow -->
	<div id="bookingFlow" class="panel hidden">
	  <div id="bookingContent"></div>
	  <div class="actions row g-0 w-100">
	    <hr>
		<div class="col-4 d-grid">
		  <button id="backBtn" class="btn btn-secondary hidden w-100"><i class="bi bi-arrow-left-circle me-1"></i> Back</button>
		</div>
		<div class="col-4 d-grid">
		  <button id="confirmBtn" class="btn btn-success hidden w-100"><i class="bi bi-check-circle me-1"></i> Confirm</button>
		</div>
		<div class="col-4 d-grid">
		  <button id="cancelBtn" class="btn btn-warning btn-lg w-100"><i class="bi bi-house me-1"></i> Back to Menu</button>
		</div>
	  </div>
	</div>

    <!-- Survey Flow -->
    <div id="surveyFlow" class="panel hidden">
      <div id="surveyContent">
<div class="mb-3">
  <label for="age" class="form-label">Age</label>
  <input type="number" class="form-control" id="age" required>
</div>
<div class="mb-3">
  <label class="form-label">Gender</label>
  <select class="form-control" id="gender" required>
    <option value="">Select Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
  </select>
</div>
<div class="mb-3">
  <label for="mobile" class="form-label">Mobile Number</label>
  <input type="text" class="form-control" id="mobile" readonly data-bs-toggle="modal" data-bs-target="#keypadModal">
</div>
</div>
	  <div class="actions row g-0 w-100">
	    <div class="col-4 d-grid">
		  <button id="surveyBackBtn" class="btn btn-secondary hidden"><i class="bi bi-arrow-left-circle me-1"></i> Back</button>
		</div>
		<div class="col-4 d-grid">
		  <button id="surveySubmitBtn" class="btn btn-success hidden" disabled><i class="bi bi-send-check me-1"></i> Submit</button>
		</div>
		<div class="col-4 d-grid">
		  <button id="surveyCancelBtn" class="btn btn-warning"><i class="bi bi-house me-1"></i> Back to Menu</button>
		</div>
	 </div> 
    </div>
	
	<!-- Track Document -->
	<div id="trackerFlow" class="panel hidden">
	  <h4><i class="bi bi-search me-2"></i>Track Document</h4>
	  <p>Enter your Document Tracking Number:</p>
	  <input id="trackId" class="form-control form-control-lg mb-3" placeholder="Document ID" readonly onclick="attachKeypad(this)">
	  <div id="trackResult"></div>
	  <div class="row g-2 mt-3">
    <div class="col-4 d-grid"><button class="btn btn-secondary btn-lg w-100" onclick="clearTracking()"><i class="bi bi-x-circle me-1"></i> Clear</button></div>
		<div class="col-4 d-grid"><button id="trackSearchBtn" class="btn btn-primary btn-lg w-100" onclick="triggerTracking()"><i class="bi bi-search me-1"></i> Search</button></div>
		<div class="col-4 d-grid"><button class="btn btn-warning btn-lg w-100" onclick="goHome()"><i class="bi bi-house me-1"></i> Home</button></div>
	  </div>
	</div>

    <!-- How to Use -->
    <div id="guideFlow" class="panel hidden">
      <h4><i class="bi bi-question-circle me-2"></i>How to Use This Kiosk</h4>
      <p class="text-muted mb-3">Follow the steps below depending on what you need.</p>

      <div class="accordion" id="guideAccordion">

        <!-- Book Transaction -->
        <div class="accordion-item mb-2">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#guide1">
              <i class="bi bi-calendar-check me-2 fs-5"></i> Book a Transaction
            </button>
          </h2>
          <div id="guide1" class="accordion-collapse collapse show" data-bs-parent="#guideAccordion">
            <div class="accordion-body fs-5">
              <ol class="mb-0">
                <li class="mb-2">Tap <strong>Book Transaction</strong> from the main menu.</li>
                <li class="mb-2">Select your <strong>Customer Type</strong>:
                  <ul class="mt-1">
                    <li><strong>Business</strong> – Private schools, companies, or establishments.</li>
                    <li><strong>Citizen</strong> – General public, learners, parents, or NGOs.</li>
                    <li><strong>Government</strong> – DepEd employees or other government agency staff. Enter your <em>7-digit Employee ID</em> (optional) and tap <strong>Continue</strong>.</li>
                  </ul>
                </li>
                <li class="mb-2">Select the <strong>Office</strong> you need to visit.</li>
                <li class="mb-2">Select the <strong>Service</strong> you need from that office.</li>
                <li class="mb-2">If prompted, select a <strong>Sub-service</strong>.</li>
                <li class="mb-2">Review the summary, then tap <strong>Confirm</strong>.</li>
                <li>Your <strong>Booking Code</strong> will appear on screen — please note it down. A QR code is also shown for your reference.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- CSM Survey -->
        <div class="accordion-item mb-2">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide2">
              <i class="bi bi-emoji-smile me-2 fs-5"></i> Client Satisfaction Measurement (CSM)
            </button>
          </h2>
          <div id="guide2" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
            <div class="accordion-body fs-5">
              <p class="mb-2">The CSM is a quick survey about your experience. You can only take it <strong>after your transaction has been verified</strong> by the office.</p>
              <ol class="mb-0">
                <li class="mb-2">Tap <strong>Client Satisfaction Measurement</strong> from the main menu.</li>
                <li class="mb-2">Tap the input box, enter your <strong>6-digit Booking Code</strong> using the keypad, then tap <strong>Validate Booking</strong>.</li>
                <li class="mb-2">Check your booking status:
                  <ul class="mt-1">
                    <li><span class="badge bg-success">Verified</span> – You may proceed with the survey.</li>
                    <li><span class="badge bg-warning text-dark">Pending Verification</span> – Please proceed to the office window first, then tap <strong>Refresh Booking Status</strong> to check again.</li>
                    <li><span class="badge bg-secondary">CSM Completed</span> – You have already submitted your survey.</li>
                  </ul>
                </li>
                <li class="mb-2">Once verified, tap <strong>START Client Satisfaction Survey</strong>.</li>
                <li class="mb-2">Provide your <strong>Age</strong>, <strong>Gender</strong>, and optional <strong>Mobile Number</strong>, then tap <strong>NEXT</strong>.</li>
                <li class="mb-2">Answer the pre-survey questions about the Citizens Charter, then tap <strong>CONTINUE</strong>.</li>
                <li class="mb-2">Answer each survey question by tapping your response.</li>
                <li class="mb-2">Choose whether to request a <strong>Certificate of Appearance</strong>.</li>
                <li>Tap <strong>Submit</strong>. If you requested a Certificate of Appearance, proceed to the Admin Office / HRMO window with your Booking Code.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- Track Document -->
        <div class="accordion-item mb-2">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide3">
              <i class="bi bi-search me-2 fs-5"></i> Track a Document
            </button>
          </h2>
          <div id="guide3" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
            <div class="accordion-body fs-5">
              <ol class="mb-0">
                <li class="mb-2">Tap <strong>Track Document</strong> from the main menu.</li>
                <li class="mb-2">Tap the input box and enter your <strong>7-digit Document Tracking Number</strong> using the keypad.</li>
                <li class="mb-2">Tap <strong>Search</strong> to view the current status and movement history of your document.</li>
                <li>Tap <strong>Clear</strong> to reset and search for a different document.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- Citizens Charter -->
        <div class="accordion-item mb-2">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guide4">
              <i class="bi bi-file-earmark-text me-2 fs-5"></i> Citizens Charter
            </button>
          </h2>
          <div id="guide4" class="accordion-collapse collapse" data-bs-parent="#guideAccordion">
            <div class="accordion-body fs-5">
              <p class="mb-0">Tap <strong>Citizens Charter</strong> from the main menu to view the official list of services, requirements, and processing times of this office. Use it as a guide before booking your transaction.</p>
            </div>
          </div>
        </div>

      </div><!-- /accordion -->

      <hr>
      <div class="actions row g-0 w-100">
        <div class="col-3 d-grid"></div>
        <div class="col-6 d-grid"><button class="btn btn-warning btn-lg w-100" onclick="goHome()"><i class="bi bi-house me-1"></i> Back to Menu</button></div>
        <div class="col-3 d-grid"></div>
      </div>
    </div>

    <!-- Citizens Charter -->
    <div id="charterFlow" class="panel hidden">
	  <h4><i class="bi bi-info-circle me-2"></i>Citizens Charter</h4>
	  <div class="ratio ratio-16x9 mb-3">
		<iframe src="{{ asset('DepEd-Citizens-Charter.pdf') }}" width="100%" height="600px"></iframe>
	  </div>
	  <hr>
	  <div class="actions row g-0 w-100">
		<div class="col-3 d-grid"></div>
		<div class="col-6 d-grid"><button class="btn btn-warning btn-lg w-100" onclick="goHome()"><i class="bi bi-house me-1"></i> Back to Menu</button></div>
		<div class="col-3 d-grid"></div>
	  </div>
	</div>

  <!-- Booking Confirmation Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
      <div class="modal-content p-3 text-center">
        <h4 class="mb-2"><i class="bi bi-check2-circle me-2"></i>Booking Confirmed</h4>
        <p class="text-muted">PLEASE SAVE THE CONFIRMATION NO. FOR THE CSM</p>
        <div id="bookingSummary" class="text-start border p-3 mb-3"></div>
        <canvas id="qrCanvas" class="mx-auto mb-2"></canvas><hr>
        <div class="row g-2">
          <div class="col-6 d-grid">
            <button class="btn btn-warning btn-lg w-100" data-bs-dismiss="modal" id="backToMenuBtn">
              <i class="bi bi-house me-1"></i> Back to Menu
            </button>
          </div>
          <div class="col-6 d-grid">
            <button class="btn btn-primary btn-lg w-100" id="bookingStatusBtn">
              <i class="bi bi-clipboard-check me-1"></i> Status
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Employee Modal (kept) -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Employee Validation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="employeeMessage"></div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
    </div>
  </div>
</div>

<!-- Numeric Keypad Modal -->
<div class="modal fade" id="keypadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top">
    <div class="modal-content text-center p-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 id="keypadTitle" class="mb-0">Enter ID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <input id="keypadTarget" type="text" class="form-control form-control-lg text-center mb-3" readonly>
      <div class="row g-2 mb-3">
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('1')">1</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('2')">2</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('3')">3</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('4')">4</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('5')">5</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('6')">6</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('7')">7</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('8')">8</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('9')">9</button></div>
        <div class="col-4 d-grid"><button class="btn btn-dark btn-lg" onclick="keypadInput('←')">←</button></div>
        <div class="col-4 d-grid"><button class="btn btn-light btn-lg" onclick="keypadInput('0')">0</button></div>
        <div class="col-4 d-grid"><button class="btn btn-dark btn-lg" onclick="keypadInput('C')">C</button></div>
      </div>

      <div id="keypadMessage" class="alert alert-danger d-none" role="alert"></div>

      {{-- Android-style circular loader shown during validation --}}
      <div id="keypadLoader" class="d-none text-center py-3">
        <div class="android-spinner"></div>
        <div class="loader-label" id="keypadLoaderText">Validating&hellip;</div>
      </div>

      <div class="d-grid gap-2">
        <button id="validateBtn" class="btn btn-primary btn-lg" onclick="validateKeypadValue()">
          <i class="bi bi-check2-circle"></i> Validate Entry
        </button>
      </div>
    </div>
  </div>
</div>

<script>
/* ========= DATA FROM SERVER ========= */
const DB_OFFICES = @json($kioskData);
const OFFICES = (function normalize(data){
    let arr = [];

    if (Array.isArray(data)) {
      arr = data;
    } else if (data && typeof data === 'object') {
      if (Array.isArray(data.offices)) arr = data.offices;
      else if (Array.isArray(data.Office)) arr = data.Office;
      else if (Array.isArray(data.items)) arr = data.items;
      else if (Array.isArray(data.data)) arr = data.data;
      else arr = Object.values(data); // last resort if it's a map
    }

    return (arr || []).map((o) => {
      const id = Number(o.id ?? o.office_id ?? o.value ?? o.code ?? o.key);
      const name = (o.name ?? o.office_name ?? o.title ?? o.label ?? o.text ?? '').toString().trim();
      const icon = o.icon ?? o.icon_class ?? o.bi ?? null;
      const services = o.services ?? o.service_list ?? o.items ?? null;
      return {
        id,
        name,
        icon,
        services: (services || []).map((s) => ({
          ...s,
          subServices: s.sub_services ?? s.subServices ?? s.children ?? [],
        })),
      };
    }).filter(o => Number.isFinite(o.id) && o.name);
  })(DB_OFFICES || []);

/* ========= HELPERS ========= */
function showTemporaryAlert(message, type = "info") {
  Swal.fire({ toast:true, position:'top', icon:type, title:message, showConfirmButton:false, timer:3000, timerProgressBar:true });
}
/* ---- Thin progress bar ---- */
let _pReqs = 0, _pTimer = null, _pVal = 0;

function showProgress() {
  const bar = document.getElementById('kioskProgressBar');
  const wrap = document.getElementById('kioskProgress');
  if (!bar || !wrap) return;
  clearInterval(_pTimer);
  _pVal = 0;
  bar.style.transition = 'none';
  bar.style.width = '0%';
  wrap.classList.add('active');
  requestAnimationFrame(() => {
    bar.style.transition = 'width .4s ease';
    bar.style.width = '35%';
    _pVal = 35;
    _pTimer = setInterval(() => {
      if (_pVal < 85) {
        _pVal += Math.random() * 7 + 1;
        bar.style.width = Math.min(_pVal, 85) + '%';
      }
    }, 500);
  });
}

function hideProgress() {
  const bar = document.getElementById('kioskProgressBar');
  const wrap = document.getElementById('kioskProgress');
  if (!bar || !wrap) return;
  clearInterval(_pTimer);
  bar.style.transition = 'width .15s ease';
  bar.style.width = '100%';
  setTimeout(() => {
    wrap.classList.remove('active');
    setTimeout(() => { bar.style.transition = 'none'; bar.style.width = '0%'; }, 280);
  }, 200);
}

function api(url, opts={}) {
  if (++_pReqs === 1) showProgress();
  return fetch(url, {headers: {'Content-Type': 'application/json', 'Accept': 'application/json', ...(opts.headers || {})}, ...opts})
    .finally(() => { if (--_pReqs <= 0) { _pReqs = 0; hideProgress(); } });
}
function isEnabledFlag(value) {
  return value === true || value === 1 || value === "1";
}
function getSurveyTransactionStatus(booking) {
  if (isEnabledFlag(booking?.is_survey)) return "CSM already completed.";
  if (isEnabledFlag(booking?.is_validated)) return "Verified. Ready for Client Satisfaction Survey.";
  return "Pending verification. Please proceed to the office for verification, then tap Refresh Booking Status.";
}
function canStartSurveyFromBooking(booking) {
  return isEnabledFlag(booking?.is_validated) && !isEnabledFlag(booking?.is_survey);
}
function getSurveyStatusType(booking) {
  if (canStartSurveyFromBooking(booking)) return "warning";
  return isEnabledFlag(booking?.is_survey) ? "warning" : "danger";
}
function buildSurveyUrl(code) {
  const url = new URL("{{ route('kiosk') }}", window.location.origin);
  url.searchParams.set("csm", code);
  return url.toString();
}
function setSurveyStartCardEnabled(enabled) {
  const card = document.getElementById("surveyStartCard");
  const label = document.getElementById("surveyStartLabel");
  const text = document.getElementById("surveyStartText");
  if (!card) return;

  card.disabled = !enabled;
  card.classList.toggle("start-enabled", enabled);
  card.classList.toggle("start-disabled", !enabled);
  if (label) label.textContent = enabled ? "START Client Satisfaction Survey" : "Client Satisfaction Measurement";
  if (text) text.textContent = enabled ? "Tap START to proceed." : "Please enter and validate your booking code first.";
}
function showSurveyStartMessage(message, type = "warning") {
  const box = document.getElementById("surveyStartMessage");
  if (!box) return;
  box.textContent = message;
  box.className = `alert alert-${type} mt-3`;
}
function hideSurveyStartMessage() {
  const box = document.getElementById("surveyStartMessage");
  if (!box) return;
  box.textContent = "";
  box.className = "alert alert-warning mt-3 d-none";
}
function setSurveyRefreshVisible(visible) {
  const btn = document.getElementById("surveyRefreshBtn");
  if (btn) btn.classList.toggle("d-none", !visible);
}
function escapeHtml(value) {
  return String(value ?? "").replace(/[&<>"']/g, (char) => ({
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#039;",
  }[char]));
}
function getSurveyStatusBadgeClass(booking) {
  if (canStartSurveyFromBooking(booking)) return "bg-success";
  if (isEnabledFlag(booking?.is_survey)) return "bg-secondary";
  return "bg-warning text-dark";
}
function getSurveyStatusBadgeText(booking) {
  if (canStartSurveyFromBooking(booking)) return "Verified";
  if (isEnabledFlag(booking?.is_survey)) return "CSM Completed";
  return "Pending Verification";
}
function clearSurveyBookingDetails() {
  const box = document.getElementById("surveyBookingDetails");
  if (box) box.innerHTML = "";
}
function showSurveyBookingDetails(booking) {
  const box = document.getElementById("surveyBookingDetails");
  if (!box) return;

  const status = getSurveyTransactionStatus(booking);
  const employeeNo = booking?.user?.employee_no || "(none)";
  const clientName = booking?.guest_name || booking?.user?.name || "(none)";
  const subService = booking?.sub_service?.name || booking?.subService?.name || "";

  box.innerHTML = `
    <div class="border p-3 mb-3 bg-light">
      <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
        <h5 class="mb-0">Booking Details</h5>
        <span class="badge ${getSurveyStatusBadgeClass(booking)}">${escapeHtml(getSurveyStatusBadgeText(booking))}</span>
      </div>
      <div class="booking-details">
        <div><strong>Booking Code:</strong></div><div>${escapeHtml(booking?.booking_code)}</div>
        <div><strong>Customer:</strong></div><div>${escapeHtml(booking?.customer_type || "-")}</div>
        <div><strong>Name:</strong></div><div>${escapeHtml(clientName)}</div>
        <div><strong>Employee ID:</strong></div><div>${escapeHtml(employeeNo)}</div>
        <div><strong>Office:</strong></div><div>${escapeHtml(booking?.office?.name || "-")}</div>
        <div><strong>Service:</strong></div><div>${escapeHtml(booking?.service?.name || "-")}</div>
        ${subService ? `<div><strong>Sub-service:</strong></div><div>${escapeHtml(subService)}</div>` : ""}
        <div><strong>Status:</strong></div><div>${escapeHtml(status)}</div>
      </div>
    </div>`;
}

/* ========= GLOBAL STATE ========= */
const steps = ["Customer Type", "Office", "Service", "Sub-service", "Confirm"];
let bookingStep = 0;
const bookingData = { type:"", employeeId:"", officeId:null, office:"", serviceId:null, service:"", subServiceId:null, subService:"", bookingCode:"", coeEmployeeNo:"", coeName:"", coeDistrict:"", coeOffice:"", purpose:"" };

const COE_PURPOSES = [
  "Employment", "Promotion", "Salary/Car Loan", "GSIS/Pag-IBIG Maturity", "Transfer",
  "Resignation", "Travel Abroad", "Visa Application", "Credit Card Application",
  "TESDA Certificate Renewal", "Correction of Personal Information", "Others"
];

let surveyIndex = -1;
let surveyQ = [];               // loaded from API
let surveyAnswers = {};         // {question_id: 'Very Satisfied' }
let surveyBookingCode = "";
let surveyCOASelected = false;

/* ========= ELEMENTS ========= */
const mainMenu = document.getElementById("mainMenu");
const bookingFlow = document.getElementById("bookingFlow");
const bookingContent = document.getElementById("bookingContent");
const surveyFlow = document.getElementById("surveyFlow");
const surveyContent = document.getElementById("surveyContent");
const charterFlow = document.getElementById("charterFlow");
const stepsBar = document.getElementById("bookingStepsBar");
const chips = document.getElementById("stepChips");
const progressBar = document.getElementById("progressBar");
const backBtn = document.getElementById("backBtn");
const cancelBtn = document.getElementById("cancelBtn");
const confirmBtn = document.getElementById("confirmBtn");
const surveyBackBtn = document.getElementById("surveyBackBtn");
const surveyCancelBtn = document.getElementById("surveyCancelBtn");
const surveySubmitBtn = document.getElementById("surveySubmitBtn");
const trackerFlow = document.getElementById("trackerFlow");
document.getElementById("homeBtn").onclick = goHome;
cancelBtn.onclick = goHome;
backBtn.onclick = onBookingBack;
confirmBtn.onclick = confirmBooking;
surveyCancelBtn.onclick = goHome;
surveyBackBtn.onclick = onSurveyBack;
surveySubmitBtn.onclick = submitSurvey;
document.getElementById("backToMenuBtn").onclick = goHome;
document.getElementById("bookingStatusBtn").onclick = openClientSatisfactionFromBooking;

/* ========= KEYPAD ========= */
let activeInput = null;
let currentType = "employee";
function attachKeypad(input) {
  activeInput  = input;
  const title  = document.getElementById("keypadTitle");
  const btn    = document.getElementById("validateBtn");
  const target = document.getElementById("keypadTarget");
  const msg    = document.getElementById("keypadMessage");

  if (input.id === "employeeId") { title.innerText = "Enter Employee ID"; btn.innerHTML = '<i class="bi bi-check2-circle"></i> Validate Employee'; currentType="employee"; }
  else if (input.id === "coeEmployeeId") { title.innerText = "Enter Employee ID"; btn.innerHTML = '<i class="bi bi-check2-circle"></i> Validate Employee'; currentType="coe-employee"; }
  else if (input.id === "surveyBookingInput") {
    title.innerText = "Enter Booking/Transaction ID";
    btn.innerHTML = '<i class="bi bi-check2-circle"></i> Validate Booking';
    currentType="booking";
    setSurveyStartCardEnabled(false);
    clearSurveyBookingDetails();
    hideSurveyStartMessage();
  }
  else if (input.id === "trackId") { title.innerText = "Enter Document ID"; btn.innerHTML = '<i class="bi bi-check2-circle"></i> Validate Document'; currentType="document"; }

  target.value = ""; btn.className = "btn btn-primary btn-lg"; btn.onclick = validateKeypadValue; msg.classList.add("d-none");
  new bootstrap.Modal(document.getElementById("keypadModal")).show();
}
function keypadInput(val) {
  const t = document.getElementById("keypadTarget");
  const msg = document.getElementById("keypadMessage");
  const btn = document.getElementById("validateBtn");
  msg.className = "alert alert-danger d-none";
  msg.textContent = "";
  btn.className = "btn btn-primary btn-lg";
  btn.innerHTML = '<i class="bi bi-check2-circle"></i> ' + (
    currentType === "employee" ? "Validate Employee" :
    currentType === "booking" ? "Validate Booking" :
    currentType === "document" ? "Validate Document" :
    "Validate Entry"
  );
  btn.onclick = validateKeypadValue;
  if (val === "C")  { t.value = ""; return; }
  if (val === "←")  { t.value = t.value.slice(0, -1); return; }
  t.value += val;
}

async function validateKeypadValue() {
  const value      = document.getElementById("keypadTarget").value.trim();
  const msg        = document.getElementById("keypadMessage");
  const btn        = document.getElementById("validateBtn");
  const loader     = document.getElementById("keypadLoader");
  const loaderText = document.getElementById("keypadLoaderText");

  // Show Android-style circular loader
  msg.classList.add("d-none");
  msg.textContent = "";
  loaderText.textContent = currentType === "employee" ? "Looking up employee…"
                         : currentType === "booking"  ? "Checking booking code…"
                         : "Searching…";
  loader.classList.remove("d-none");
  btn.disabled = true;

  let valid = false, name = "", transactionStatus = "", canStartSurvey = false, transactionStatusType = "warning", validatedBooking = null, employeeLookup = null;

  try {
    if (currentType === "employee" || currentType === "coe-employee") {
      if(!/^\d{7}$/.test(value)) throw { message: 'Employee ID must be 7 digits' };
      const r = await api(`/api/employees/validate/${encodeURIComponent(value)}`);
      const data = await r.json();
      if(!r.ok) throw data;
      valid = true; name = data.name || ""; employeeLookup = data;
    } else if (currentType === "booking") {
      if(!/^\d{6}$/.test(value)) throw { message: 'Booking Code must be 6 digits' };
      const r = await api(`/api/bookings/code/${encodeURIComponent(value)}`);
      const data = await r.json();
      if(!r.ok) throw data;
      valid = true; name = (data.guest_name || (data.user && data.user.name) || '');
      validatedBooking = data;
      transactionStatus = getSurveyTransactionStatus(data);
      canStartSurvey = canStartSurveyFromBooking(data);
      transactionStatusType = getSurveyStatusType(data);
    } else if (currentType === "document") {
      if (!/^\d{7}$/.test(value)) throw { message: 'Document ID must be 7 digits' };
      const r = await api(`/api/docs/${encodeURIComponent(value)}`);
      const data = await r.json();
      if(!r.ok) throw data;
      valid = true; name = data.title || `Document ${value}`;
    }
  } catch (e) {
    valid = false;
  }

  // Hide loader, restore button
  loader.classList.add("d-none");
  btn.disabled = false;

  if (valid) {
    if (currentType === "employee" || currentType === "coe-employee") {
      msg.textContent = `Welcome! ${name || 'Employee'}. Tap PROCEED to continue.`;
      msg.className = "alert alert-warning";
    } else if (currentType === "booking") {
      msg.textContent = `Transaction Status: ${transactionStatus}`;
      msg.className = "alert alert-warning";
    } else {
      msg.classList.add("d-none");
    }

    btn.innerHTML = '<i class="bi bi-arrow-right-circle"></i> Proceed';
    btn.classList.remove("btn-primary"); btn.classList.add("btn-success");
    btn.onclick = () => {
      if (activeInput) activeInput.value = value;
      const modalEl = document.getElementById("keypadModal");
      const m = bootstrap.Modal.getInstance(modalEl);
      if (m) m.hide();

      if (currentType === "employee") {
        continueFromGovernment();
      }
      if (currentType === "coe-employee") {
        onCoeEmployeeValidated(value, employeeLookup);
      }
      if (currentType === "booking") {
        setSurveyStartCardEnabled(canStartSurvey);
        showSurveyBookingDetails(validatedBooking);
        showSurveyStartMessage(transactionStatus, transactionStatusType);
        setSurveyRefreshVisible(true);
      }
      if (currentType === "document") showTemporaryAlert(`${name} found.`, "success");
    };
  } else {
    let message = "Entry not Found";
    if (currentType === "employee" || currentType === "coe-employee") message = "Employee ID is 7 digits and Exist.";
    if (currentType === "booking")  message = "Booking Code 6 digits and Exist.";
    if (currentType === "document") message = "Document ID is 7 digits and Valid or Exist.";
    msg.textContent = message;
    msg.className = "alert alert-danger";
    setTimeout(() => msg.classList.add("d-none"), 3000);
  }
}


/* ========= NAV ========= */
function goHome(){
  bookingStep=0; Object.keys(bookingData).forEach(k=>bookingData[k]=["officeId","serviceId","subServiceId"].includes(k)?null:"");
  surveyIndex=-1; surveyQ=[]; surveyAnswers={}; surveyBookingCode=""; surveyCOASelected=false;
  mainMenu.classList.remove("hidden");
  bookingFlow.classList.add("hidden"); 
  surveyFlow.classList.add("hidden"); 
  charterFlow.classList.add("hidden");
  trackerFlow.classList.add("hidden");
  document.getElementById("guideFlow").classList.add("hidden");
  stepsBar.classList.add("hidden");
  document.getElementById("trackResult").innerHTML = "";
  document.getElementById("trackId").value = "";
}
function showTracker(){ mainMenu.classList.add("hidden"); document.getElementById("trackerFlow").classList.remove("hidden"); }
function startBooking(){ mainMenu.classList.add("hidden"); bookingFlow.classList.remove("hidden"); stepsBar.classList.remove("hidden"); bookingStep=0; renderBooking(); }
function startSurvey(){ mainMenu.classList.add("hidden"); surveyFlow.classList.remove("hidden"); renderSurvey(); }
function showCharter(){ mainMenu.classList.add("hidden"); charterFlow.classList.remove("hidden"); }
function showGuide(){ mainMenu.classList.add("hidden"); document.getElementById("guideFlow").classList.remove("hidden"); }
function escapeJs(value) {
  return String(value || "").replace(/\\/g, "\\\\").replace(/'/g, "\\'");
}
function getSelectedService() {
  const office = OFFICES.find(o => Number(o.id) === Number(bookingData.officeId));
  return (office?.services || []).find(s => Number(s.id) === Number(bookingData.serviceId));
}
function selectedServiceHasSubServices() {
  return (getSelectedService()?.subServices || []).length > 0;
}

/* ========= BOOKING FLOW (DB-driven) ========= */
function renderBooking(){
  const stepsLine = steps.map((s, i) => (i===bookingStep?`<strong>Step ${i+1}: ${s}</strong>`:`Step ${i+1}: ${s}`)).join(" → ");
  chips.innerHTML = `<p class="mb-2 text-center">${stepsLine}</p>`;
  const pct = ((bookingStep + 1) / steps.length) * 100;
  progressBar.style.width = pct + "%";
  progressBar.style.backgroundColor = ["yellow","orange","red","green"][bookingStep] || "yellow";
  backBtn.classList.toggle("hidden", bookingStep === 0);
  confirmBtn.classList.toggle("hidden", bookingStep !== 4);

  if (bookingStep === 0){
    bookingContent.innerHTML=`
      <h3 class="mb-3">Select Type of Customer</h3>
      <button class="menu-btn" onclick="selectCustomer('Business')"><div class="menu-header"><i class="bi bi-building"></i><span>Business</span></div><p>Private School, Corporations, Companies, or Establishments, etc. transacting with the office.</p></button>
      <button class="menu-btn" onclick="selectCustomer('Citizen')"><div class="menu-header"><i class="bi bi-person"></i><span>Citizen</span></div><p>General Public, Learners, Parents, former DepEd Employees, Researchers, NGOs etc. availing of personal or community-related services.</p></button>
      <button class="menu-btn" id="govBtn"><div class="menu-header"><i class="bi bi-bank"></i><span>Government</span></div><p>Current DepEd Employees or Employees of other Government Agencies & LGUs transactions with government departments and offices.</p></button>
      <div id="employeeWrap" class="hidden mt-3">
        <div class="row g-2">
          <div class="col-8"><input id="employeeId" class="form-control form-control-lg" placeholder="Employee ID (optional)" readonly onclick="attachKeypad(this)"></div>
          <div class="col-4 d-grid"><button class="btn btn-warning btn-lg" onclick="continueFromGovernment()"><i class="bi bi-arrow-right-circle me-1"></i> Continue</button></div>
        </div>
      </div>`;
    setTimeout(()=>{ document.getElementById("govBtn").onclick=()=>{ bookingData.type="Government"; document.getElementById("employeeWrap").classList.remove("hidden"); }; },0);
  }

  if (bookingStep === 1) {
  bookingContent.innerHTML = `
    <h3 class="mb-3">Select Office</h3>
    <div class="office-grid">
      ${OFFICES.map(o => `
        <button type="button" class="menu-btn office-btn" data-office-id="${o.id}">
          <div class="menu-content">
            <div class="menu-header">
              <i class="bi ${o.icon ? o.icon : '${o.icon}'}"></i>
              <span>${o.name}</span>
            </div>
          </div>
        </button>
      `).join('')}
    </div>
  `;

  backBtn?.classList?.remove('hidden');
  return;
}


  if (bookingStep === 2){
    const office = OFFICES.find(o => Number(o.id) === Number(bookingData.officeId));
    let services = (office?.services || []).map(s => `
      <button class="btn-kiosk" onclick="selectService(${s.id}, '${escapeJs(s.name)}')">
        <i class="bi bi-receipt"></i> ${s.name}
      </button>
    `).join('');
    bookingContent.innerHTML=`<h3 class="mb-3">Select Service</h3>${services || '<div class="alert alert-danger">No services configured for this office.</div>'}`;
  }

  if (bookingStep === 3){
    if (selectedServiceHasSubServices()) {
      const subServices = (getSelectedService()?.subServices || []).map(s => `
        <button class="btn-kiosk" onclick="selectSubService(${s.id}, '${escapeJs(s.name)}')">
          <i class="bi bi-list-check"></i> ${s.name}
        </button>
      `).join('');
      bookingContent.innerHTML=`<h3 class="mb-3">Select Sub-service</h3>${subServices}`;
      return;
    }
    bookingStep = 4;
    renderBooking();
    return;
  }

  if (bookingStep === 4){
    if (bookingData.subService === 'COE Request') {
      renderCoeRequestStep();
      return;
    }
    confirmBtn.disabled = false;
    bookingContent.innerHTML=`
      <h3 class="mb-3">Summary & Confirm</h3>
      <div class="border p-3">
        <p><strong>Customer:</strong> ${bookingData.type||"-"}</p>
        <p><strong>Employee ID:</strong> ${bookingData.employeeId||"(none)"}</p>
        <p><strong>Office:</strong> ${bookingData.office||"-"}</p>
        <p><strong>Service:</strong> ${bookingData.service||"-"}</p>
        ${bookingData.subService ? `<p><strong>Sub-service:</strong> ${bookingData.subService}</p>` : ""}
      </div>`;
  }
}

/* ========= COE REQUEST (custom sub-service form) ========= */
function renderCoeRequestStep(){
  const looked = !!bookingData.coeEmployeeNo;
  bookingContent.innerHTML = `
    <h3 class="mb-3">Certificate of Employment (COE) Request</h3>
    <div class="border p-3">
      <div class="mb-3">
        <label class="form-label fw-bold">Employee ID</label>
        <div class="row g-2">
          <div class="col-8"><input id="coeEmployeeId" class="form-control form-control-lg" placeholder="Employee ID (7 digits)" readonly onclick="attachKeypad(this)" value="${bookingData.coeEmployeeNo||''}"></div>
          <div class="col-4 d-grid"><button type="button" class="btn btn-warning btn-lg" onclick="attachKeypad(document.getElementById('coeEmployeeId'))"><i class="bi bi-search me-1"></i> Look up</button></div>
        </div>
      </div>
      ${looked ? `
        <p><strong>Name:</strong> ${escapeHtml(bookingData.coeName)||'-'}</p>
        <p><strong>District:</strong> ${escapeHtml(bookingData.coeDistrict)||'-'}</p>
        <p><strong>School/Office:</strong> ${escapeHtml(bookingData.coeOffice)||'-'}</p>
      ` : `<p class="text-muted">Enter your Employee ID above and tap <strong>Look up</strong> to auto-fill your Name, District, and School/Office.</p>`}
      <div class="mb-2">
        <label for="coePurpose" class="form-label fw-bold">Purpose</label>
        <select id="coePurpose" class="form-control form-control-lg" onchange="bookingData.purpose=this.value; updateCoeConfirmState();">
          <option value="">-- Select Purpose --</option>
          ${COE_PURPOSES.map(p => `<option value="${p}" ${bookingData.purpose===p?'selected':''}>${p}</option>`).join('')}
        </select>
      </div>
    </div>`;
  updateCoeConfirmState();
}

function onCoeEmployeeValidated(employeeNo, data){
  bookingData.coeEmployeeNo = employeeNo;
  bookingData.coeName = data?.name || "";
  bookingData.coeDistrict = data?.district || "";
  bookingData.coeOffice = data?.office_name || "";
  renderCoeRequestStep();
}

function updateCoeConfirmState(){
  confirmBtn.disabled = !(bookingData.coeEmployeeNo && bookingData.purpose);
}

// Make sure clicks/taps on any tile work, even after re-render
(function setupOfficeDelegation(){
  const container = document.getElementById('bookingContent') ||
                    document.querySelector('#booking-content, .booking-content');
  if (!container) return;

  container.addEventListener('click', (e) => {
    const btn = e.target.closest('.office-btn');
    if (!btn) return;

    const id = parseInt(btn.dataset.officeId, 10);
    if (!Number.isFinite(id)) return;

    selectOfficeById(id);
  }, { passive: true });
})();


function selectOfficeById(id){
  const office = OFFICES.find(o => Number(o.id) === Number(id));
  if (!office) return;

  bookingData.officeId  = office.id;
  bookingData.office    = office.name;
  bookingData.serviceId = null;
  bookingData.service   = null;
  bookingData.subServiceId = null;
  bookingData.subService = "";

  // go to Step 2 and re-render
  bookingStep = 2;
  if (typeof renderBooking === 'function') renderBooking();
}


function selectCustomer(type){ bookingData.type=type; bookingStep=1; renderBooking(); }
function continueFromGovernment(){ bookingData.employeeId=document.getElementById("employeeId").value.trim(); bookingStep=1; renderBooking(); }
function selectOffice(id, name){
  bookingData.officeId=id;
  bookingData.office=name;
  bookingData.serviceId=null;
  bookingData.service="";
  bookingData.subServiceId=null;
  bookingData.subService="";
  bookingStep=2;
  renderBooking();
}
function selectService(id, name){
  bookingData.serviceId=id;
  bookingData.service=name;
  bookingData.subServiceId=null;
  bookingData.subService="";
  bookingData.coeEmployeeNo=""; bookingData.coeName=""; bookingData.coeDistrict=""; bookingData.coeOffice=""; bookingData.purpose="";
  bookingStep=selectedServiceHasSubServices()?3:4;
  renderBooking();
}
function selectSubService(id, name){ bookingData.subServiceId=id; bookingData.subService=name; bookingStep=4; renderBooking(); }
function onBookingBack(){
  if(bookingStep>0){
    bookingStep--;
    if (bookingStep === 3 && !selectedServiceHasSubServices()) bookingStep = 2;
    renderBooking();
  }
}

async function confirmBooking() {
  const payload = {
    customer_type: bookingData.type,
    office_id: bookingData.officeId,
    service_id: bookingData.serviceId,
    sub_service_id: bookingData.subServiceId,
    scheduled_at: null,
    // COE Request always carries its own validated employee ID; otherwise fall back to the general flow's
    employee_no: bookingData.coeEmployeeNo || (bookingData.employeeId && /^\d{7}$/.test(bookingData.employeeId) ? bookingData.employeeId : null),
    purpose: bookingData.purpose || null,
    // Keep these if you later add guest inputs for citizens/business
    guest_name: null,
    guest_contact: null,
  };

  const bookingsApi = "{{ url('/api/bookings') }}";

  try{
    showProgress();
    const r = await fetch(bookingsApi, {
      method:'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify(payload)
    });
    const data = await r.json();
    if(!r.ok) throw data;

    bookingData.bookingCode = data.booking_code;
    document.getElementById("bookingSummary").innerHTML = `
      <div class="booking-details">
        <div><h5><strong>Booking Code:</strong></h5></div>
        <div><h5><strong>${data.booking_code}</strong></h5></div>
        <div><strong>Customer:</strong></div><div>${bookingData.type}</div>
        <div><strong>Employee ID:</strong></div><div>${bookingData.coeEmployeeNo || bookingData.employeeId || "(none)"}</div>
        <div><strong>Office:</strong></div><div>${bookingData.office}</div>
        <div><strong>Service:</strong></div><div>${bookingData.service}</div>
        ${bookingData.subService ? `<div><strong>Sub-service:</strong></div><div>${bookingData.subService}</div>` : ""}
        ${bookingData.purpose ? `<div><strong>Purpose:</strong></div><div>${bookingData.purpose}</div>` : ""}
      </div>`;
    new QRious({ element: document.getElementById("qrCanvas"), value: buildSurveyUrl(data.booking_code), size: 220 });
    hideProgress();
    new bootstrap.Modal(document.getElementById("bookingModal")).show();
  }catch(err){
    hideProgress();
    Swal.fire({icon:'error', title:'Booking failed', text: (err?.message || 'Please check inputs')});
  }
}



/* ========= SURVEY ========= */
let surveyStep = 0;
  const surveyData = {
    age: null,
    gender: null,
    contact: null,
    employee_no: null,
    office_id: null,
    service_id: null,
    sub_service_id: null,
    customer_type: null,
  };

  function prefillSurveyMetaFromBooking() {
    try {
      surveyData.employee_no  = bookingData?.employee_no ?? null;
      surveyData.office_id    = bookingData?.officeId ?? null;
      surveyData.service_id   = bookingData?.serviceId ?? null;
      surveyData.sub_service_id = bookingData?.subServiceId ?? null;
      surveyData.customer_type= bookingData?.customer_type ?? null; // 'employee'|'guest'
    } catch (_) {}
  }

function renderSurvey(){
  if(surveyIndex===-1){
    surveyContent.innerHTML=`
      <h4>Enter Transaction/Booking ID</h4>
      <input id="surveyBookingInput" placeholder="Please enter Transaction ID before proceeding..." class="form-control form-control-lg mb-3" readonly onclick="attachKeypad(this)">
      <div id="surveyBookingDetails"></div>
      <button id="surveyRefreshBtn" type="button" class="btn btn-primary btn-lg w-100 mb-3 d-none" onclick="refreshSurveyBookingStatus()">
        <i class="bi bi-arrow-clockwise me-1"></i> Refresh Booking Status
      </button>
      <button id="surveyStartCard" type="button" class="menu-btn start-disabled" onclick="proceedSurveyBookingId()" disabled>
        <div class="menu-header"><i class="bi bi-emoji-smile"></i><span id="surveyStartLabel">Client Satisfaction Measurement</span></div>
        <hr>
        <p>Please scan or enter your booking code to start the survey.</p>
        <p><strong id="surveyStartText">Please enter and validate your booking code first.</strong></p>
      </button>
      <div id="surveyStartMessage" class="alert alert-warning mt-3 d-none"></div>
      <p>CSM is in accordance with RA No. 11032 (ARTA) to monitor and improve service quality.</p>
    `;
    surveyBackBtn.classList.add("hidden"); surveySubmitBtn.classList.add("hidden");
    return;
  }

  if(surveyIndex < surveyQ.length){
    const q = surveyQ[surveyIndex];
    surveyContent.innerHTML = `
      <h4>Question ${surveyIndex+1}</h4>
      <p class="fs-4 fw-bold mt-2 mb-4">${q.question}</p>
      <div class="d-grid gap-2">
        ${[
          { label: '<i class="bi bi-emoji-heart-eyes-fill"></i> Strongly Agree (5)', value: '5' },
          { label: '<i class="bi bi-emoji-smile-fill"></i> Agree (4)', value: '4' },
          { label: '<i class="bi bi-emoji-neutral-fill"></i> Neither Agree nor Disagree (3)', value: '3' },
          { label: '<i class="bi bi-emoji-frown-fill"></i> Disagree (2)', value: 'Disagree (2)' },
          { label: '<i class="bi bi-emoji-angry-fill"></i> Strongly Disagree (1)', value: '1' },
          { label: '<i class="bi bi-hand-thumbs-up"></i> Not Applicable', value: '0' }
        ].map(ans => `
          <button class="btn-kiosk" onclick="answerSurvey(${q.id}, '${ans.value}')">
            ${ans.label}
          </button>
        `).join('')}
      </div>
    `;
    surveyBackBtn.classList.toggle("hidden",surveyIndex===0);
    surveySubmitBtn.classList.add("hidden");
  } else {
    surveyContent.innerHTML = `
      <br><center><h4>Request Certificate of Appearance?</h4>
      <div class="d-flex justify-content-center gap-5 mt-3">
        <div class="form-check d-flex align-items-center">
          <input type="radio" class="form-check-input big-radio" name="coa" id="coaYes">
          <label class="form-check-label big-label ms-2" for="coaYes">Yes</label>
        </div>
        <div class="form-check d-flex align-items-center">
          <input type="radio" class="form-check-input big-radio" name="coa" id="coaNo">
          <label class="form-check-label big-label ms-2" for="coaNo">No</label>
        </div>
      </div><br><hr>`;
    surveyBackBtn.classList.remove("hidden");
    surveySubmitBtn.classList.remove("hidden"); surveySubmitBtn.disabled=true;
    document.querySelectorAll("input[name='coa']").forEach(r=>r.onchange=()=>{ surveyCOASelected = (document.getElementById('coaYes').checked); surveySubmitBtn.disabled=false; });
  }
}

async function refreshSurveyBookingStatus(){
    const codeEl = document.getElementById("surveyBookingInput");
    const code = (codeEl?.value || '').trim();

    setSurveyStartCardEnabled(false);
    if(!/^\d{6}$/.test(code)){
      clearSurveyBookingDetails();
      showSurveyStartMessage("Please enter a valid 6-digit Booking Code.", "warning");
      setSurveyRefreshVisible(Boolean(code));
      codeEl?.focus();
      return;
    }

    try{
      const r = await api(`/api/bookings/code/${encodeURIComponent(code)}`);
      const data = await r.json();
      if(!r.ok) throw data;

      const canStart = canStartSurveyFromBooking(data);
      setSurveyStartCardEnabled(canStart);
      showSurveyBookingDetails(data);
      showSurveyStartMessage(getSurveyTransactionStatus(data), getSurveyStatusType(data));
      setSurveyRefreshVisible(true);
    }catch(err){
      setSurveyStartCardEnabled(false);
      clearSurveyBookingDetails();
      showSurveyStartMessage(err.message || "Booking not found.", "danger");
      setSurveyRefreshVisible(true);
    }
}

function openClientSatisfactionStatus(code) {
    if (!/^\d{6}$/.test(code || "")) return;

    mainMenu.classList.add("hidden");
    bookingFlow.classList.add("hidden");
    charterFlow.classList.add("hidden");
    trackerFlow.classList.add("hidden");
    stepsBar.classList.add("hidden");
    surveyFlow.classList.remove("hidden");
    surveyIndex = -1;
    renderSurvey();

    const codeEl = document.getElementById("surveyBookingInput");
    if (codeEl) codeEl.value = code;
    refreshSurveyBookingStatus();
}

function openClientSatisfactionFromBooking() {
    const code = bookingData.bookingCode;
    if (!code) return;

    const modalEl = document.getElementById("bookingModal");
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();

    openClientSatisfactionStatus(code);
}

async function proceedSurveyBookingId(){
    const codeEl = document.getElementById("surveyBookingInput");
    const code   = (codeEl?.value || '').trim();

    if(!code){
      showSurveyStartMessage("Please enter a Booking Code.", "warning");
      codeEl?.focus();
      return;
    }

    try{
      // Hit your existing start endpoint
      const r = await api(`/api/surveys/start/${encodeURIComponent(code)}`);
      const data = await r.json();
      if(!r.ok) throw data;

      // Prime survey session
      surveyBookingCode = code;
      surveyQ           = data.questions || [];
      surveyAnswers     = {};

      // If booking meta was set earlier, copy it now (optional but harmless)
      prefillSurveyMetaFromBooking();

      // Show demographics FIRST (Age, Gender, Contact), then Q1
      surveyStep = 0;
      renderSurveyDemographics();
      return;
    }catch(err){
      showSurveyStartMessage(err.message || "Booking not validated or not found.", "danger");
      codeEl?.focus();
      return;
    }
}


  function getCSMContainer() {
    if (typeof surveyContent !== 'undefined' && surveyContent) return surveyContent;
    return document.getElementById('surveyContent')
        || document.getElementById('csmContent')
        || document.getElementById('bookingContent')
        || document.querySelector('#csm, #booking-content, .booking-content, .kiosk-body');
  }

  function gotoCSMQuestion1() {
    surveyStep  = 1;   // marker if you need it
    surveyIndex = 0;   // start at first question
    renderSurvey();    // your existing function that draws Question 1+ based on surveyIndex
  }


  function renderSurveyDemographics() {
  const el = getCSMContainer();
  if (!el) return;


  const ageOptions = Array.from({length: 76}, (_, i) => {
  const age = i + 15;
  return `<option value="${age}">${age}</option>`;
}).join('');


  // Plain content (no box)
  el.innerHTML = `
    <h4 class="mb-3">Client Satisfaction Measurement</h4>
    <p class="mb-3 text-muted">Please provide the following:</p>

    <form id="csm-demographics" novalidate>
  <div class="tab-content">

    <!-- TAB 1: Demographics -->
    <div class="tab-pane fade show active" id="panel-demographics" role="tabpanel">
      <div class="row g-4 fs-4">
        <div class="col-md-4">
          <label class="form-label">Age <span class="text-danger">*</span></label>
          <select class="form-select" name="age" required>
            <option value="">Select</option>
            @for ($i = 15; $i <= 100; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Gender <span class="text-danger">*</span></label>
          <select class="form-select" name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
            <option value="prefer_not_to_say">Prefer not to say</option>
          </select>
        </div>

        <div class="col-md-4 position-relative">
          <label class="form-label">Mobile No.</label>
          <input type="tel" class="form-control" id="csm-contact" name="contact" value=""
                pattern="^[0-9+]{7,15}$" inputmode="none" autocomplete="off" readonly
                onfocus="showNumKeypad(this)" onclick="showNumKeypad(this)">
          <div id="num-keypad" class="num-keypad d-none">
            <div class="keypad-row">
              <button type="button" class="keypad-btn" onclick="kpType('1')">1</button>
              <button type="button" class="keypad-btn" onclick="kpType('2')">2</button>
              <button type="button" class="keypad-btn" onclick="kpType('3')">3</button>
            </div>
            <div class="keypad-row">
              <button type="button" class="keypad-btn" onclick="kpType('4')">4</button>
              <button type="button" class="keypad-btn" onclick="kpType('5')">5</button>
              <button type="button" class="keypad-btn" onclick="kpType('6')">6</button>
            </div>
            <div class="keypad-row">
              <button type="button" class="keypad-btn" onclick="kpType('7')">7</button>
              <button type="button" class="keypad-btn" onclick="kpType('8')">8</button>
              <button type="button" class="keypad-btn" onclick="kpType('9')">9</button>
            </div>
            <div class="keypad-row">
              <button type="button" class="keypad-btn keypad-back" onclick="kpBack()">⌫</button>
              <button type="button" class="keypad-btn" onclick="kpType('0')">0</button>
              <button type="button" class="keypad-btn keypad-done" onclick="kpDone()">Done ✓</button>
            </div>
          </div>
        </div>
      </div>

      <div class="text-end mt-5">
        <button type="button" id="btn-next-tab" class="btn btn-warning btn-lg px-5 text-light">NEXT >>></button>
      </div>
      <hr>
    </div>

    <!-- TAB 2: Pre-questions -->
    <div class="tab-pane fade" id="panel-prequestions" role="tabpanel">
      <div class="fs-4">

        <div class="mb-5">
          <p class="fw-bold mb-3">Are you aware of the Citizen's Charter - document of the SDO services and requirements?</p>
          <div class="d-grid gap-2">
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_aware" id="q1-yes" value="Yes" required>
              <label class="btn-kiosk-opt" for="q1-yes"><i class="bi bi-check-circle-fill"></i> Yes</label>
            </div>
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_aware" id="q1-no" value="No">
              <label class="btn-kiosk-opt" for="q1-no"><i class="bi bi-x-circle-fill"></i> No</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="mb-5">
          <p class="fw-bold mb-3">Did you see the SDO Citizen's Charter (online or posted in the office)?</p>
          <div class="d-grid gap-2">
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_see" id="q2-yes-easy" value="Yes-easy" required>
              <label class="btn-kiosk-opt" for="q2-yes-easy"><i class="bi bi-eye-fill"></i> Yes - it was easy to find</label>
            </div>
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_see" id="q2-yes-hard" value="Yes-hard">
              <label class="btn-kiosk-opt" for="q2-yes-hard"><i class="bi bi-search"></i> Yes - but it was hard to find</label>
            </div>
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_see" id="q2-no" value="No">
              <label class="btn-kiosk-opt" for="q2-no"><i class="bi bi-x-circle-fill"></i> No</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="mb-4">
          <p class="fw-bold mb-3">Did you use the SDO Citizen's Charter as a guide for the service you availed?</p>
          <div class="d-grid gap-2">
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_used" id="q3-yes" value="Yes" required>
              <label class="btn-kiosk-opt" for="q3-yes"><i class="bi bi-check-circle-fill"></i> Yes</label>
            </div>
            <div class="cc-opt">
              <input class="cc-radio" type="radio" name="cc_used" id="q3-no" value="No">
              <label class="btn-kiosk-opt" for="q3-no"><i class="bi bi-x-circle-fill"></i> No</label>
            </div>
          </div>
        </div>

      </div>

      <div class="text-end mt-5">
        <button type="submit" class="btn btn-success btn-lg px-5"> CONTINUE </button>
      </div>

    </div>

  </div>
</form> `;

  // restore previous entries
  const f = el.querySelector('#csm-demographics');
  if (f) {
      if (surveyData.age != null)     f.age.value = String(surveyData.age);
      if (surveyData.gender)          f.gender.value = surveyData.gender;
      if (surveyData.contact)         f.contact.value = surveyData.contact;
  }

  document.getElementById('btn-next-tab').addEventListener('click', function () {
  document.getElementById('panel-demographics').classList.remove('show', 'active');
  document.getElementById('panel-prequestions').classList.add('show', 'active');
});

  // submit handler (Age & Gender required; Mobile optional)
  f?.addEventListener('submit', (e) => {
    e.preventDefault();

    const ageVal     = f.age.value.trim();
    const genderVal  = f.gender.value.trim();
    const contactVal = f.contact.value.trim();
    const cc_awareVal = f.cc_aware.value.trim();
    const cc_seeVal = f.cc_see.value.trim();
    const cc_usedVal = f.cc_used.value.trim();
    //const remarksVal = f.remarks.value.trim();

    // reset UI
    f.age.classList.remove('is-invalid');
    f.gender.classList.remove('is-invalid');
    f.contact.classList.remove('is-invalid');

    let ok = true;

    // required checks
    if (!ageVal || !(Number(ageVal) >= 1 && Number(ageVal) <= 100)) {
      f.age.classList.add('is-invalid'); ok = false;
    }
    if (!genderVal) {
      f.gender.classList.add('is-invalid'); ok = false;
    }
    // optional phone format
    if (contactVal && !(new RegExp('^[0-9+]{7,15}$').test(contactVal))) {
      f.contact.classList.add('is-invalid'); ok = false;
    }
    if (!ok) return;

    // save to state
    surveyData.age     = Number(ageVal);
    surveyData.gender  = genderVal;
    surveyData.contact = contactVal || null;
    surveyData.cc_aware = cc_awareVal;
    surveyData.cc_see = cc_seeVal;
    surveyData.cc_used = cc_usedVal;
    //surveyData.remarks = remarksVal;

    // proceed to Question 1
    gotoCSMQuestion1();
  });
}



function answerSurvey(qid, ans){
  surveyAnswers[qid] = ans;
  surveyIndex++; renderSurvey();
}
function onSurveyBack(){ surveyIndex=Math.max(-1,surveyIndex-1); renderSurvey(); }

async function submitSurvey(){
  document.getElementById('submitSpinner').classList.remove('d-none');
  try{
    const answers = Object.keys(surveyAnswers).map(qid => ({ question_id: Number(qid), answer: surveyAnswers[qid] }));
   const r = await api('/api/surveys/submit', {
      method:'POST',
      body: JSON.stringify({
        booking_code: surveyBookingCode,
        requested_coa: !!surveyCOASelected,
        // answers...
        answers: Object.keys(surveyAnswers).map(qid => ({ question_id: Number(qid), answer: surveyAnswers[qid] })),
        // demographics & meta
        age: surveyData.age,
        gender: surveyData.gender,
        contact: surveyData.contact,
        employee_no: surveyData.employee_no,
        office_id: surveyData.office_id,
        service_id: surveyData.service_id,
        customer_type: surveyData.customer_type,
        cc_aware: surveyData.cc_aware,
        cc_see: surveyData.cc_see,
        cc_used: surveyData.cc_used,
        //remarks: surveyData.remarks,
      })
    });
    const data = await r.json();
    if(!r.ok) throw data;

    document.getElementById('submitSpinner').classList.add('d-none');
    document.getElementById('coaInstruction').style.display = surveyCOASelected ? '' : 'none';
    new bootstrap.Modal(document.getElementById('surveySuccessModal')).show();
  }catch(err){
    document.getElementById('submitSpinner').classList.add('d-none');
    showTemporaryAlert(err.message || "Failed to submit survey.", "error");
  }
}

/* ========= TRACKER (sample only) ========= */
function triggerTracking(){
  const id = document.getElementById("trackId").value.trim();
  if (!id) { showTemporaryAlert("⚠️ Please enter a Document ID first.", "warning"); return; }
  document.getElementById("trackResult").innerHTML = "";
  searchDocument(id);
}

async function searchDocument(){
  const trackId = document.getElementById("trackId").value.trim();
  const resultBox = document.getElementById("trackResult");

  if (!/^\d{7}$/.test(trackId)) {    // 8 digits
    resultBox.innerHTML = `<div class="alert alert-danger">❌ Tracking # must be 7 digits.</div>`;
    return;
  }

  resultBox.innerHTML = '';
  showProgress();
  try{
    const r = await fetch(`/api/docs/${encodeURIComponent(trackId)}`);
    const data = await r.json();
    if(!r.ok) throw data;

    let html = `
      <div class="card mb-3 p-3 shadow-sm">
        <h5 class="mb-2"><i class="bi bi-file-earmark-text me-2"></i>${data.title}</h5>
        <p class="mb-1"><strong>Tracking Number:</strong> ${data.tracking_no}</p>
        <p class="mb-1"><strong>Sender:</strong> ${data.sender ?? ''}</p>
        <p class="mb-1"><strong>Date Filed:</strong> ${data.date_filed ?? ''}</p>
        <p class="mb-1"><strong>From:</strong> ${data.from_office ?? ''}</p>
        <p class="mb-1"><strong>To:</strong> ${data.to_office ?? ''}</p>
        <p class="mb-0"><strong>For:</strong> ${data.for_user ?? ''}</p>
      </div>
      <div class="timeline">
        ${ (data.updates || []).map((u, idx, arr) => {
            const isLatest = (idx === arr.length - 1) ? 'latest' : '';
            let icon = 'bi-clock';
            if (u.status.includes('Received')) icon = 'bi-inbox';
            if (u.status.includes('Processing')) icon = 'bi-hourglass-split';
            if (u.status.includes('Approval')) icon = 'bi-check2-square';
            if (u.status.includes('Released')) icon = 'bi-check-circle-fill';
            return `
              <div class="timeline-item ${isLatest}">
                <div class="timeline-icon"><i class="bi ${icon}"></i></div>
                <div class="timeline-content">
                  <h6>${u.status}</h6>
                  <p class="small text-muted">${u.date ?? ''}</p>
                  <p>${u.details ?? ''}</p>
                </div>
              </div>
            `;
        }).join('') }
      </div>
    `;
    hideProgress();
    resultBox.innerHTML = html;
  }catch(err){
    hideProgress();
    resultBox.innerHTML = `<div class="alert alert-danger">❌ Document not found.</div>`;
  }
}


function clearTracking(){ document.getElementById("trackId").value = ""; document.getElementById("trackResult").innerHTML = ""; }

/* ========= NUMERIC KEYPAD ========= */
let kpTarget = null;
function showNumKeypad(el) {
  kpTarget = el;
  const kp = document.getElementById('num-keypad');
  if (kp) kp.classList.remove('d-none');
}
function kpType(digit) {
  if (!kpTarget) return;
  if (kpTarget.value.length < 15) kpTarget.value += digit;
}
function kpBack() {
  if (!kpTarget) return;
  kpTarget.value = kpTarget.value.slice(0, -1);
}
function kpDone() {
  const kp = document.getElementById('num-keypad');
  if (kp) kp.classList.add('d-none');
  kpTarget = null;
}
document.addEventListener('click', function (e) {
  const kp = document.getElementById('num-keypad');
  if (!kp || kp.classList.contains('d-none')) return;
  if (!kp.contains(e.target) && e.target !== kpTarget) kpDone();
});

/* ========= INIT ========= */
goHome();
</script>

<!-- Submitting Spinner Overlay -->
<div id="submitSpinner" class="d-none">
  <div class="spinner-ring mb-4"></div>
  <div class="fs-3 fw-bold">Submitting your response&hellip;</div>
  <div class="mt-2 fs-5 text-warning">Please wait</div>
</div>

<!-- Survey Success Modal -->
<div class="modal fade" id="surveySuccessModal" tabindex="-1"
     data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content text-center p-4 p-md-5">

      <div class="mb-3">
        <i class="bi bi-patch-check-fill text-success" style="font-size:5rem;"></i>
      </div>
      <h2 class="fw-bold mb-2">Thank You!</h2>
      <p class="fs-5 text-muted mb-4">Your survey response has been submitted successfully.</p>

      <!-- COA instruction — shown only when requested_coa = true -->
      <div id="coaInstruction" class="alert alert-warning border-2 border-warning p-4 text-start"
           style="display:none; border-left: 6px solid #FFD700 !important;">
        <div class="d-flex align-items-start gap-3">
          <i class="bi bi-printer-fill fs-2 text-dark mt-1 flex-shrink-0"></i>
          <div>
            <h5 class="fw-bold mb-1">Certificate of Appearance — Next Step</h5>
            <p class="fs-5 mb-1">
              You requested a <strong>Certificate of Appearance (CA)</strong>.
            </p>
            <p class="fs-5 mb-0">
              Please proceed to the <strong>Admin Office / HRMO Window</strong>
              and present your <strong>Booking Code</strong> for the printing of your certificate.
            </p>
          </div>
        </div>
      </div>

      <div class="mt-4">
        <button class="btn btn-warning btn-lg px-5 fw-bold" style="font-size:1.3rem;"
                data-bs-dismiss="modal" onclick="goHome()">
          <i class="bi bi-house-fill me-2"></i> Back to Menu
        </button>
      </div>

    </div>
  </div>
</div>

<!-- Keypad Modal -->
<div class="modal fade" id="keypadModal" tabindex="-1" aria-labelledby="keypadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Enter Mobile Number</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body text-center">
        <input type="text" id="keypadInput" class="form-control mb-3 text-center" readonly>
        <div class="d-grid gap-2">
          <div class="btn-group" role="group">
            <button class="btn btn-secondary" onclick="appendDigit(1)">1</button>
            <button class="btn btn-secondary" onclick="appendDigit(2)">2</button>
            <button class="btn btn-secondary" onclick="appendDigit(3)">3</button>
          </div>
          <div class="btn-group" role="group">
            <button class="btn btn-secondary" onclick="appendDigit(4)">4</button>
            <button class="btn btn-secondary" onclick="appendDigit(5)">5</button>
            <button class="btn btn-secondary" onclick="appendDigit(6)">6</button>
          </div>
          <div class="btn-group" role="group">
            <button class="btn btn-secondary" onclick="appendDigit(7)">7</button>
            <button class="btn btn-secondary" onclick="appendDigit(8)">8</button>
            <button class="btn btn-secondary" onclick="appendDigit(9)">9</button>
          </div>
          <div class="btn-group" role="group">
            <button class="btn btn-danger" onclick="clearInput()">C</button>
            <button class="btn btn-secondary" onclick="appendDigit(0)">0</button>
            <button class="btn btn-success" onclick="confirmMobile()">OK</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Confirm Your Details</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body">
        <p><strong>Age:</strong> <span id="confirmAge"></span></p>
        <p><strong>Gender:</strong> <span id="confirmGender"></span></p>
        <p><strong>Mobile Number:</strong> <span id="confirmMobile"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="finalizeSurvey()">Confirm</button>
      </div>
    </div>
  </div>
</div>

<script>
function appendDigit(num) {
  document.getElementById('keypadInput').value += num;
}
function clearInput() {
  document.getElementById('keypadInput').value = '';
}
function confirmMobile() {
  document.getElementById('mobile').value = document.getElementById('keypadInput').value;
  bootstrap.Modal.getInstance(document.getElementById('keypadModal')).hide();
}
document.getElementById('surveySubmitBtn').addEventListener('click', function() {
  if (!document.getElementById('age').value || !document.getElementById('gender').value || !document.getElementById('mobile').value) {
    showTemporaryAlert("Please complete the demographic fields.", "warning");
    return;
  }
  document.getElementById('confirmAge').innerText = document.getElementById('age').value;
  document.getElementById('confirmGender').innerText = document.getElementById('gender').value;
  document.getElementById('confirmMobile').innerText = document.getElementById('mobile').value;
  bootstrap.Modal.getOrCreateInstance(document.getElementById('confirmModal')).show();
});
function finalizeSurvey() {
  surveyData.age = document.getElementById('age').value;
  surveyData.gender = document.getElementById('gender').value;
  surveyData.contact = document.getElementById('mobile').value;
  bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
  submitSurvey();
}

function openClientSatisfactionFromUrl() {
  const params = new URLSearchParams(window.location.search);
  const code = (params.get('csm') || '').trim();
  if (!/^\d{6}$/.test(code)) return;

  openClientSatisfactionStatus(code);
}

setTimeout(openClientSatisfactionFromUrl, 0);

function toggleFullscreen() {
  if (!document.fullscreenElement) {
    document.documentElement.requestFullscreen().catch(() => {});
  } else {
    document.exitFullscreen().catch(() => {});
  }
}

document.addEventListener('fullscreenchange', () => {
  const icon = document.getElementById('fullscreenIcon');
  if (!icon) return;
  icon.className = document.fullscreenElement ? 'bi bi-fullscreen-exit' : 'bi bi-fullscreen';
});

// ===== Screensaver =====
(function () {
  const enabled     = @json($ssMasterEnabled);
  const mode        = @json($ssMode);
  const videos      = @json($ssVideos);
  const images      = @json($ssImages);
  const media       = mode === 'image' ? images : videos;
  const imgInterval = {{ $ssImageInterval }} * 1000;
  const timeout     = {{ $ssTimeout }} * 1000;
  const overlay     = document.getElementById('screensaverOverlay');
  const player      = document.getElementById('ssPlayer');
  let   timer    = null;
  let   imgTimer = null;
  let   idx      = 0;
  let   active   = false;
  let   ytReady  = false;
  let   ytPlayer = null;

  if (!enabled || !media.length || !overlay) return;

  // ---- URL helpers ----
  function getYouTubeId(url) {
    const m = url.match(/(?:youtube\.com\/watch\?[^#]*v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/);
    return m ? m[1] : null;
  }

  // Convert any path to a URL the browser can load:
  //   D:\videos\clip.mp4  →  file:///D:/videos/clip.mp4
  //   file:///...         →  unchanged
  //   https://...         →  unchanged
  //   relative/path.mp4   →  served from this server
  function toMediaUrl(path) {
    if (/^(https?|file):\/\//i.test(path)) return path;          // already a URL
    if (/^[a-zA-Z]:[\\\/]/.test(path))                           // Windows drive path
      return 'file:///' + path.replace(/\\/g, '/');
    return '{{ asset('') }}' + path;                              // server-relative path
  }

  const hasYT = mode === 'video' && videos.some(v => getYouTubeId(v));
  if (hasYT) {
    const s = document.createElement('script');
    s.src = 'https://www.youtube.com/iframe_api';
    document.head.appendChild(s);
  }
  window.onYouTubeIframeAPIReady = function () { ytReady = true; };

  // ---- Player management ----
  function clearPlayer() {
    clearTimeout(imgTimer);
    if (ytPlayer) { try { ytPlayer.destroy(); } catch (e) {} ytPlayer = null; }
    player.innerHTML = '';
  }

  function loadMedia() {
    clearPlayer();
    if (mode === 'image') { loadImage(); return; }
    const url  = videos[idx];
    const ytId = getYouTubeId(url);
    ytId ? loadYouTube(ytId) : loadLocal(url);
  }

  function loadImage() {
    const img = document.createElement('img');
    img.src = toMediaUrl(images[idx]);
    img.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
    player.appendChild(img);
    imgTimer = setTimeout(advance, imgInterval);
  }

  function loadLocal(url) {
    const v = document.createElement('video');
    v.src       = toMediaUrl(url);
    v.muted     = true;
    v.autoplay  = true;
    v.playsInline = true;
    v.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
    v.addEventListener('ended', advance);
    player.appendChild(v);
    v.play().catch(() => {});
  }

  function loadYouTube(ytId) {
    const div = document.createElement('div');
    div.id = 'ss-yt-player';
    div.style.cssText = 'width:100%;height:100%;';
    player.appendChild(div);

    const create = function () {
      ytPlayer = new YT.Player('ss-yt-player', {
        videoId: ytId,
        playerVars: { autoplay: 1, mute: 1, controls: 0, rel: 0, modestbranding: 1, iv_load_policy: 3 },
        events: {
          onReady: function (e) {
            const iframe = e.target.getIframe();
            iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:0;';
          },
          onStateChange: function (e) {
            if (e.data === YT.PlayerState.ENDED) advance();
          },
        },
      });
    };

    if (ytReady) { create(); }
    else {
      const orig = window.onYouTubeIframeAPIReady;
      window.onYouTubeIframeAPIReady = function () { ytReady = true; if (orig) orig(); create(); };
    }
  }

  function advance() {
    idx = (idx + 1) % media.length;
    loadMedia();
  }

  // ---- Screensaver lifecycle ----
  function startTimer() {
    clearTimeout(timer);
    timer = setTimeout(showScreensaver, timeout);
  }

  function showScreensaver() {
    active = true;
    overlay.style.display = 'block';
    idx = 0;
    loadMedia();
  }

  function hideScreensaver() {
    active = false;
    overlay.style.display = 'none';
    clearPlayer();
    startTimer();
  }

  overlay.addEventListener('click',      hideScreensaver);
  overlay.addEventListener('touchstart', function (e) { e.preventDefault(); hideScreensaver(); }, { passive: false });

  ['touchstart', 'touchmove', 'click', 'mousemove', 'keydown', 'scroll'].forEach(function (evt) {
    document.addEventListener(evt, function () { if (!active) startTimer(); }, { passive: true });
  });

  startTimer();
})();
</script>

@php $kioskFooter = \App\Models\AppSetting::getValue('kiosk_footer', ''); @endphp
@if($kioskFooter)
<div class="kiosk-footer">{{ $kioskFooter }}</div>
@endif
</body>
</html>
