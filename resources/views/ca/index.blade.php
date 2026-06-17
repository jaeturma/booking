
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Certificates</h2>
  </x-slot>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @push('styles')
    @include('partials.vendor-dt-bs5-styles')
  @endpush

  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm ring-1 ring-gray-200 sm:rounded-lg p-4">

        <div class="table-responsive">
          <table id="certificatesTable" class="table table-sm table-striped table-hover table-bordered align-middle w-100">
            <thead class="table-light">
              <tr>
                <th>CA No.</th>
                <th>Client</th>
                <th>Office</th>
                <th>Issued</th>
                <th>OB/OT</th>
                <th>Printed</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($certificates as $c)
                <tr>
                  <td>{{ $c->certificate_number }}</td>
                  <td>{{ $c->guest_name }}</td>
                  <td>{{ $c->office->name ?? '' }}</td>
                  <td>{{ $c->issued_at->format('M d, Y h:i A') }}</td>
                  <td class="text-left align-middle">
                    <span
                      role="button"
                      class="badge ob-ot-badge {{ $c->ob_ot === 'OB' ? 'bg-success text-white' : 'bg-success text-white' }}"
                      data-id="{{ $c->id }}"
                      data-value="{{ $c->ob_ot }}"
                      data-url="{{ route('certificates.toggle-ob-ot', $c) }}"
                      data-bs-toggle="modal"
                      data-bs-target="#obOtModal"
                    >
                      {{ $c->ob_ot }}
                    </span>
                  </td>
                  <td>
                  @if ($c->printed_at)
                    <span class="badge bg-success">Yes</span>
                  @else
                    <span class="badge bg-warning">No</span>
                  @endif
                </td>
                  <td class="text-end">
                    
                  <a href="{{ route('certificates.print-fresh', $c) }}" target="_blank" class="btn btn-success btn-sm">Fresh</a>
                  <a href="{{ route('certificates.print-esign', $c) }}" target="_blank" class="btn btn-primary btn-sm">E-Sign</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>


<!-- OB/OT Modal -->
<div class="modal fade" id="obOtModal" tabindex="-1" aria-labelledby="obOtModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="obOtModalLabel">Set OB / OT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="obOtForm">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="obOtCsrf">
          <input type="hidden" name="url" id="obOtUrl">
          <input type="hidden" name="cert_id" id="obOtCertId">

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="ob_ot" id="obOption" value="OB">
              <label class="form-check-label" for="obOption">OB - Official Business</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="ob_ot" id="otOption" value="OT">
              <label class="form-check-label" for="otOption">OT - Official Time</label>
            </div>
          </div>
        </form>

        <div id="obOtAlert" class="alert d-none" role="alert"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="obOtSaveBtn" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>




  @push('scripts')
    @include('partials.vendor-dt-bs5-scripts')
    <script>
      $(function () {
        $('#certificatesTable').DataTable();
      });
    </script>
    
   <script>
    document.addEventListener('DOMContentLoaded', function () {
      const obOtModalEl = document.getElementById('obOtModal');
      const obOtModal = new bootstrap.Modal(obOtModalEl);
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.getElementById('obOtCsrf')?.value;

      // When modal is shown, populate fields from clicked badge
      obOtModalEl.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget; // element that triggered modal
        if (!trigger) return;

        const url = trigger.getAttribute('data-url');
        const certId = trigger.getAttribute('data-id');
        const current = trigger.getAttribute('data-value');

        document.getElementById('obOtUrl').value = url;
        document.getElementById('obOtCertId').value = certId;

        // set radio according to current value
        document.getElementById('obOption').checked = (current === 'OB');
        document.getElementById('otOption').checked = (current === 'OT');

        // hide any previous alerts
        const alertDiv = document.getElementById('obOtAlert');
        alertDiv.classList.add('d-none');
        alertDiv.textContent = '';
      });

      // Save button handler
      document.getElementById('obOtSaveBtn').addEventListener('click', async function () {
        const url = document.getElementById('obOtUrl').value;
        const certId = document.getElementById('obOtCertId').value;
        const value = document.querySelector('input[name="ob_ot"]:checked')?.value;

        if (!url || !value) {
          showAlert('Please choose OB or OT.', 'danger');
          return;
        }

        try {
          const res = await fetch(url, {
            method: 'PATCH',
            headers: {
              'X-CSRF-TOKEN': csrf,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ value: value })
          });

          if (!res.ok) {
            const text = await res.text();
            throw new Error('Request failed: ' + res.status + ' ' + text);
          }

          const data = await res.json();

          if (data.status !== 'success') {
            throw new Error(data.message || 'Unexpected response');
          }

          // update the badge in the table row (find element with data-id)
          const badge = document.querySelector('.ob-ot-badge[data-id="'+certId+'"]');
          if (badge) {
            badge.textContent = data.value;
            badge.setAttribute('data-value', data.value);

            // update classes (green for OB, secondary for OT)
            badge.classList.remove('bg-success','bg-secondary','text-white');
            if (data.value === 'OB') {
              badge.classList.add('bg-success','text-white');
            } else {
              badge.classList.add('bg-secondary','text-white');
            }
          }

          obOtModal.hide();
        } catch (err) {
          console.error(err);
          showAlert('Failed to update OB/OT: ' + (err.message || ''), 'danger');
        }
      });

      // helper to show an alert inside the modal
      function showAlert(message, type = 'success') {
        const alertDiv = document.getElementById('obOtAlert');
        alertDiv.className = 'alert alert-' + type;
        alertDiv.textContent = message;
        alertDiv.classList.remove('d-none');
      }
    });
    </script>
  @endpush
</x-app-layout>
