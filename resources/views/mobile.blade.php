<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Kiosk UI (Mobile)</title>
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
    .header .brand { display:flex; align-items:center; gap:.6rem; font-weight:700; }
    .header .brand i { font-size:1.4rem; }
    .btn, .form-control, .modal-content, .card, .progress, .progress-bar { border-radius:0!important; }

    .wrap { max-width:980px; margin:0 auto; padding:16px; }
	
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

  .form-check-input.radio-gold {
    background-color: #FFD700 !important;
    border: 2px solid #333;
    width: 1.2rem;
    height: 1.2rem;
  }

  .form-check-input.radio-gold:checked {
    background-color: #FFD700 !important;
    border-color: #222 !important;
  }

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
    .modal-dialog-top { margin: 40px auto !important; }
    .form-check-input.big-radio { width: 2rem; height: 2rem; }
    .form-check-label.big-label { font-size: 1.5rem; font-weight: bold; margin-left: 0.5rem; }
      
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
  
  
/* Mobile-friendly tweaks: ensure inputs and buttons are comfortably tappable */
@media (max-width: 576px) {
  .form-control-lg { font-size: 1.05rem; padding: .65rem .85rem; }
  .menu-btn { padding: 14px; }
  .actions .btn { padding: .65rem .75rem; }
  .panel { padding: 14px; }
}
</style>
</head>
<body>

  <!-- Header -->
	<div class="header py-3">
	  <div class="wrap d-flex align-items-center justify-content-between">
		<div class="brand">
		  <i class="bi bi-tablet"></i>
		  <span>Self-Service Kiosk</span>
		</div>
		<button id="homeBtn" class="btn btn-outline-dark">
		  <i class="bi bi-house-fill me-1"></i> Home
		</button>
	  </div>
	</div>

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
		  <p>Schedule and manage your office transaction easily by booking in advance, ensuring faster processing and avoiding long queues.</p>
		</div>
	  </button>

	  <button class="menu-btn" onclick="startSurvey()">
		<div class="menu-content">
		  <div class="menu-header">
			<i class="bi bi-emoji-smile"></i>
			<span>Client Satisfaction Measurement</span>
		  </div>
		  <hr>
		  <p>Your feedback helps us improve our services. Please provide input for your validated transaction.</p>
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
	  <input id="trackId" class="form-control form-control-lg mb-3" placeholder="Document ID" inputmode="numeric" autocomplete="one-time-code" pattern="\d{7}" maxlength="7">
	  <small class="text-muted d-block mt-1">Use your device keyboard. 7-digit Document ID.</small><div id="trackResult"></div>
	  <div class="row g-2 mt-3">
		<div class="col-4 d-grid"><button class="btn btn-dark btn-lg w-100" onclick="goHome()"><i class="bi bi-house me-1"></i> Home</button></div>
		<div class="col-4 d-grid"><button id="trackSearchBtn" class="btn btn-primary btn-lg w-100" onclick="triggerTracking()"><i class="bi bi-search me-1"></i> Search</button></div>
		<div class="col-4 d-grid"><button class="btn btn-secondary btn-lg w-100" onclick="clearTracking()"><i class="bi bi-x-circle me-1"></i> Clear</button></div>
	  </div>
	</div>

    <!-- Citizens Charter -->
    <div id="charterFlow" class="panel hidden">
	  <h4><i class="bi bi-info-circle me-2"></i>Citizens Charter</h4>
	  <div class="ratio ratio-16x9 mb-3">
		<iframe src="/DepEd-Citizens-Charter.pdf" width="100%" height="600px"></iframe>
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
        <p class="text-muted">Please save this QR code.</p>
        <div id="bookingSummary" class="text-start border p-3 mb-3"></div>
        <canvas id="qrCanvas" class="mx-auto mb-2"></canvas><hr>
        <button class="btn btn-secondary w-100" data-bs-dismiss="modal" id="backToMenuBtn">
          <i class="bi bi-house-door me-1"></i> Back to Menu
        </button>
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
      return { id, name, icon, services };
    }).filter(o => Number.isFinite(o.id) && o.name);
  })(DB_OFFICES || []);

/* ========= HELPERS ========= */
function showTemporaryAlert(message, type = "info") {
  Swal.fire({ toast:true, position:'top', icon:type, title:message, showConfirmButton:false, timer:3000, timerProgressBar:true });
}
function api(url, opts={}){ return fetch(url, {headers:{'Content-Type':'application/json', ...(opts.headers||{})}, ...opts}); }

/* ========= GLOBAL STATE ========= */
const steps = ["Customer Type", "Office", "Service", "Confirm"];
let bookingStep = 0;
const bookingData = { type:"", employeeId:"", officeId:null, office:"", serviceId:null, service:"", bookingCode:"" };

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

/* ========= KEYPAD ========= */
let activeInput = null;
let currentType = "employee";

  else if (input.id === "surveyBookingInput") { title.innerText = "Enter Booking/Transaction ID"; btn.innerHTML = '<i class="bi bi-check2-circle"></i> Validate Booking'; currentType="booking"; }
  else if (input.id === "trackId") { title.innerText = "Enter Document ID"; btn.innerHTML = '<i class="bi bi-check2-circle"></i> Validate Document'; currentType="document"; }

  target.value = ""; btn.className = "btn btn-primary btn-lg"; btn.onclick = validateKeypadValue; msg.classList.add("d-none");
}

  if (val === "←")  { t.value = t.value.slice(0, -1); return; }
  t.value += val;
}

async $/.test(value)) throw { message: 'Employee ID must be 7 digits' };
      const r = await api(`/api/employees/validate/${encodeURIComponent(value)}`);
      const data = await r.json();
      if(!r.ok) throw data;
      valid = true; name = data.name || "";
    } else if (currentType === "booking") {
      if(!/^\d{6}$/.test(value)) throw { message: 'Booking Code must be 6 digits' };
      const r = await api(`/api/bookings/code/${encodeURIComponent(value)}`);
      const data = await r.json();
      if(!r.ok) throw data;
      valid = true; name = (data.guest_name || (data.user && data.user.name) || '');
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

  if (valid) {
    btn.innerHTML = '<i class="bi bi-arrow-right-circle"></i> Proceed';
    btn.classList.remove("btn-primary"); btn.classList.add("btn-success");
    btn.onclick = () => {
      if (activeInput) activeInput.value = value;
      const m = bootstrap.Modal.getInstance(modalEl);
      if (m) m.hide();

      if (currentType === "employee") showTemporaryAlert(`Welcome ${name||'Employee'}!`, "success");
      if (currentType === "booking")  showTemporaryAlert(`Booking created by ${name||'client'} You can sart the CSM now`, "info");
      if (currentType === "document") showTemporaryAlert(`${name} found.`, "success");
    };
  } else {
    let message = "Entry not Found";
    if (currentType === "employee") message = "Employee ID is 7 digits and Exist.";
    if (currentType === "booking")  message = "Booking Code 6 digits and Exist.";
    if (currentType === "document") message = "Document ID is 7 digits and Valid or Exist.";
    msg.textContent = message;
    msg.classList.remove("d-none");
    setTimeout(() => msg.classList.add("d-none"), 3000);
  }
}


/* ========= NAV ========= */
function goHome(){
  bookingStep=0; Object.keys(bookingData).forEach(k=>bookingData[k]=["officeId","serviceId"].includes(k)?null:"");
  surveyIndex=-1; surveyQ=[]; surveyAnswers={}; surveyBookingCode=""; surveyCOASelected=false;
  mainMenu.classList.remove("hidden");
  bookingFlow.classList.add("hidden"); 
  surveyFlow.classList.add("hidden"); 
  charterFlow.classList.add("hidden"); 
  trackerFlow.classList.add("hidden");    // ✅ hide tracker
  stepsBar.classList.add("hidden");
  document.getElementById("trackResult").innerHTML = "";
  document.getElementById("trackId").value = "";
}
function showTracker(){ mainMenu.classList.add("hidden"); document.getElementById("trackerFlow").classList.remove("hidden"); }
function startBooking(){ mainMenu.classList.add("hidden"); bookingFlow.classList.remove("hidden"); stepsBar.classList.remove("hidden"); bookingStep=0; renderBooking(); }
function startSurvey(){ mainMenu.classList.add("hidden"); surveyFlow.classList.remove("hidden"); renderSurvey(); }
function showCharter(){ mainMenu.classList.add("hidden"); charterFlow.classList.remove("hidden"); }

/* ========= BOOKING FLOW (DB-driven) ========= */
function renderBooking(){
  const stepsLine = steps.map((s, i) => (i===bookingStep?`<strong>Step ${i+1}: ${s}</strong>`:`Step ${i+1}: ${s}`)).join(" → ");
  chips.innerHTML = `<p class="mb-2 text-center">${stepsLine}</p>`;
  const pct = ((bookingStep + 1) / steps.length) * 100;
  progressBar.style.width = pct + "%";
  progressBar.style.backgroundColor = ["yellow","orange","red","green"][bookingStep] || "yellow";
  backBtn.classList.toggle("hidden", bookingStep === 0);
  confirmBtn.classList.toggle("hidden", bookingStep !== 3);

  if (bookingStep === 0){
    bookingContent.innerHTML=`
      <h3 class="mb-3">Select Type of Customer</h3>
      <button class="menu-btn" onclick="selectCustomer('Business')"><div class="menu-header"><i class="bi bi-building"></i><span>Business</span></div><p>Private entities transacting with the office.</p></button>
      <button class="menu-btn" onclick="selectCustomer('Citizen')"><div class="menu-header"><i class="bi bi-person"></i><span>Citizen</span></div><p>General public, learners, parents, NGOs.</p></button>
      <button class="menu-btn" id="govBtn"><div class="menu-header"><i class="bi bi-bank"></i><span>Government</span></div><p>Current DepEd or other government employees.</p></button>
      <div id="employeeWrap" class="hidden mt-3">
        <div class="row g-2">
          <div class="col-8"><input id="employeeId" class="form-control form-control-lg" placeholder="Employee ID (optional)" inputmode="numeric" autocomplete="one-time-code" pattern="\d{7}" maxlength="7"><small class="text-muted d-block mt-1">Use your device keyboard. 7 digits (optional).</small></div>
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
              <i class="bi ${o.icon ? o.icon : 'bi-building'}"></i>
              <span>${o.name}</span>
            </div>
          </div>
        </button>
      `).join('')}
    </div>
  `;

  backBtn?.classList?.remove('hidden');
  nextBtn?.classList?.add('hidden');
  return;
}


  if (bookingStep === 2){
    const office = OFFICES.find(o => Number(o.id) === Number(bookingData.officeId));
    let services = (office?.services || []).map(s => `
      <button class="btn-kiosk" onclick="selectService(${s.id}, '${s.name.replace(/'/g,"\\'")}')">
        <i class="bi bi-receipt"></i> ${s.name}
      </button>
    `).join('');
    bookingContent.innerHTML=`<h3 class="mb-3">Select Service</h3>${services || '<div class="alert alert-danger">No services configured for this office.</div>'}`;
  }

  if (bookingStep === 3){
    bookingContent.innerHTML=`
      <h3 class="mb-3">Summary & Confirm</h3>
      <div class="border p-3">
        <p><strong>Customer:</strong> ${bookingData.type||"-"}</p>
        <p><strong>Employee ID:</strong> ${bookingData.employeeId||"(none)"}</p>
        <p><strong>Office:</strong> ${bookingData.office||"-"}</p>
        <p><strong>Service:</strong> ${bookingData.service||"-"}</p>
      </div>`;
  }
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

  // go to Step 2 and re-render
  bookingStep = 2;
  if (typeof renderBooking === 'function') renderBooking();
}


function selectCustomer(type){ bookingData.type=type; bookingStep=1; renderBooking(); }
function continueFromGovernment(){ bookingData.employeeId=document.getElementById("employeeId").value.trim(); bookingStep=1; renderBooking(); }
function selectOffice(id, name){ bookingData.officeId=id; bookingData.office=name; bookingStep=2; renderBooking(); }
function selectService(id, name){ bookingData.serviceId=id; bookingData.service=name; bookingStep=3; renderBooking(); }
function onBookingBack(){ if(bookingStep>0){ bookingStep--; renderBooking(); } }

async function confirmBooking() {
  const payload = {
    customer_type: bookingData.type,
    office_id: bookingData.officeId,
    service_id: bookingData.serviceId,
    scheduled_at: null,
    // If an employee ID was provided, send it so backend can map the user
    employee_no: bookingData.employeeId && /^\d{7}$/.test(bookingData.employeeId) ? bookingData.employeeId : null,
    // Keep these if you later add guest inputs for citizens/business
    guest_name: null,
    guest_contact: null,
  };

  const bookingsApi = "{{ url('/api/bookings') }}";

  try{
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
        <div><strong>Employee ID:</strong></div><div>${bookingData.employeeId || "(none)"}</div>
        <div><strong>Office:</strong></div><div>${bookingData.office}</div>
        <div><strong>Service:</strong></div><div>${bookingData.service}</div>
      </div>`;
    new QRious({ element: document.getElementById("qrCanvas"), value: data.booking_code, size: 220 });
    new bootstrap.Modal(document.getElementById("bookingModal")).show();
  }catch(err){
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
    customer_type: null,
  };

  function prefillSurveyMetaFromBooking() {
    try {
      surveyData.employee_no  = bookingData?.employee_no ?? null;
      surveyData.office_id    = bookingData?.officeId ?? null;
      surveyData.service_id   = bookingData?.serviceId ?? null;
      surveyData.customer_type= bookingData?.customer_type ?? null; // 'employee'|'guest'
    } catch (_) {}
  }

function renderSurvey(){
  if(surveyIndex===-1){
    surveyContent.innerHTML=`
      <h4>Enter Transaction/Booking ID</h4>
      <input id="surveyBookingInput" placeholder="Please enter Transaction ID before proceeding..." class="form-control form-control-lg mb-3" inputmode="numeric" autocomplete="one-time-code" pattern="\d{6}" maxlength="6">
      <small class="text-muted d-block mt-1">Use your device keyboard. 6-digit Booking/Transaction code.</small><button class="menu-btn" onclick="proceedSurveyBookingId()">
        <div class="menu-header"><i class="bi bi-emoji-smile"></i><span>Client Satisfaction Measurement</span></div>
        <hr>
        <p>Please scan or enter your booking code to start the survey.</p>
        <p><strong>Please TAP to Proceed</strong></p>
      </button>
      <p>CSM is in accordance with RA No. 11032 (ARTA) to monitor and improve service quality.</p>
    `;
    surveyBackBtn.classList.add("hidden"); surveySubmitBtn.classList.add("hidden");
    return;
  }

  if(surveyIndex < surveyQ.length){
    const q = surveyQ[surveyIndex];
    surveyContent.innerHTML = `
      <h4>Question ${surveyIndex+1}</h4>
      <p>${q.question}</p>
      <div class="d-grid gap-2">
        ${['Very Satisfied','Satisfied','Neutral','Dissatisfied'].map(ans=>`
          <button class="btn-kiosk" onclick="answerSurvey(${q.id}, '${ans}')">${ans}</button>
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

async function proceedSurveyBookingId(){
    const codeEl = document.getElementById("surveyBookingInput");
    const code   = (codeEl?.value || '').trim();

    if(!code){
      showTemporaryAlert("Please enter a Booking Code.", "warning");
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
      showTemporaryAlert(err.message || "Booking not validated or not found.", "error");
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
            @for ($i = 1; $i <= 100; $i++)
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

        <div class="col-md-4">
          <label class="form-label">Mobile No.</label>
          <input type="tel" class="form-control" name="contact" placeholder="e.g. 09xxxxxxxxx"
                 pattern="^[0-9+]{7,15}$" inputmode="tel">
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

        <div class="mb-4">
          <label class="form-label">Are you aware of the Citizen's Charter - document of the SDO services and requirements?</label>
          <div class="d-flex justify-content-left flex-wrap gap-4">
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_aware" id="q1-yes" value="Yes" required>
              <label class="form-check-label fs-4" for="q1-yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_aware" id="q1-no" value="No">
              <label class="form-check-label fs-4" for="q1-no">No</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="mb-4">
          <label class="form-label">Did you see the SDO Citizen's Charter (online or posted in the office)?</label>
          <div class="d-flex justify-content-left flex-wrap gap-4">
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_see" id="q2-yes-easy" value="Yes-easy" required>
              <label class="form-check-label fs-4" for="q2-yes-easy">Yes - it was easy to find</label>
            </div></br>
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_see" id="q2-yes-hard" value="Yes-hard">
              <label class="form-check-label fs-4" for="q2-yes-hard">Yes - but it was hard to find</label>
            </div></br>
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_see" id="q3-no" value="No">
              <label class="form-check-label fs-4" for="q3-no">No</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="mb-4">
          <label class="form-label">Did you use the SDO Citizen's Charter as a guide for the service you availed?</label>
          <div class="d-flex justify-content-left flex-wrap gap-4">
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_used" id="q3-yes" value="Yes" required>
              <label class="form-check-label fs-4" for="q3-yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input radio-gold rounded-circle" type="radio" name="cc_used" id="q3-no" value="No">
              <label class="form-check-label fs-4" for="q3-no">No</label>
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

    goHome();
    setTimeout(()=>showTemporaryAlert("Thank you! Survey submitted. </br>Please proceed to Admin Office for your CA if you have requested.", "success"),200);
  }catch(err){
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
    resultBox.innerHTML = html;
  }catch(err){
    resultBox.innerHTML = `<div class="alert alert-danger">❌ Document not found.</div>`;
  }
}


function clearTracking(){ document.getElementById("trackId").value = ""; document.getElementById("trackResult").innerHTML = ""; }

/* ========= INIT ========= */
goHome();
</script>

<!-- Keypad Modal -->
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Enter Mobile Number</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body text-center">
        <input type="text" id="keypadInput" class="form-control mb-3 text-center">
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
</script>

</body>
</html>
