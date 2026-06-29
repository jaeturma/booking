<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      CA Today
    </h2>
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
                @can('manage-certificates')<th class="text-end">Action</th>@endcan
              </tr>
            </thead>
            <tbody>
              @foreach($certificates as $c)
              <tr>
                <td>{{ $c->certificate_number }}</td>
                <td>{{ $c->guest_name }}</td>
                <td>{{ $c->office->name ?? '' }}</td>
                <td>{{ $c->issued_at->format('M d, Y h:i A') }}</td>
                <td>
                  @can('manage-certificates')
                  <span role="button"
                        class="badge ob-ot-badge {{ $c->ob_ot === 'OB' ? 'bg-success' : 'bg-secondary' }}"
                        data-id="{{ $c->id }}"
                        data-value="{{ $c->ob_ot }}"
                        data-url="{{ route('certificates.toggle-ob-ot', $c) }}"
                        data-bs-toggle="modal"
                        data-bs-target="#obOtModal">
                    {{ $c->ob_ot }}
                  </span>
                  @else
                  <span class="badge {{ $c->ob_ot === 'OB' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $c->ob_ot }}
                  </span>
                  @endcan
                </td>
                <td>
                  @if($c->printed_at)
                    <span class="badge bg-success">Yes</span>
                  @else
                    <span class="badge bg-warning">No</span>
                  @endif
                </td>
                @can('manage-certificates')
                <td class="text-end text-nowrap">
                  <a href="{{ route('certificates.print-fresh', $c) }}" target="_blank"
                     class="btn btn-success btn-sm me-1">Fresh</a>
                  <a href="{{ route('certificates.print-esign', $c) }}" target="_blank"
                     class="btn btn-primary btn-sm">E-Sign</a>
                </td>
                @endcan
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  @can('manage-certificates')
  <div class="modal fade" id="obOtModal" tabindex="-1" aria-labelledby="obOtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="obOtModalLabel">Set OB / OT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="obOtForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="url" id="obOtUrl">
            <input type="hidden" name="cert_id" id="obOtCertId">
            <div class="mb-2">
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
          <button id="obOtSaveBtn" type="button" class="btn btn-primary ms-1">Save</button>
        </div>
      </div>
    </div>
  </div>
  @endcan

  @push('scripts')
    @include('partials.vendor-dt-bs5-scripts')
    <script>
    $(function () {
      const dt = $('#certificatesTable').DataTable({
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
        responsive: true,
        order: [[3, 'desc']],
        @can('manage-certificates')
        columnDefs: [{ targets: [-1], orderable: false }],
        @endcan
      });

      window.__dt = window.__dt || {};
      window.__dt['certificatesTable'] = dt;

      @can('manage-certificates')
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const obOtModal = document.getElementById('obOtModal');

      obOtModal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        document.getElementById('obOtUrl').value    = trigger.dataset.url;
        document.getElementById('obOtCertId').value = trigger.dataset.id;
        const current = trigger.dataset.value;
        document.getElementById('obOption').checked = current === 'OB';
        document.getElementById('otOption').checked = current === 'OT';
        document.getElementById('obOtAlert').className = 'alert d-none';
        document.getElementById('obOtAlert').textContent = '';
      });

      document.getElementById('obOtSaveBtn').addEventListener('click', async function () {
        const url    = document.getElementById('obOtUrl').value;
        const certId = document.getElementById('obOtCertId').value;
        const value  = document.querySelector('input[name="ob_ot"]:checked')?.value;

        if (!value) { showAlert('Please choose OB or OT.', 'danger'); return; }

        try {
          const res = await fetch(url, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify({ value }),
          });
          if (!res.ok) throw new Error('Request failed: ' + res.status);
          const data = await res.json();
          if (data.status !== 'success') throw new Error(data.message || 'Unexpected response');

          const badge = document.querySelector('.ob-ot-badge[data-id="' + certId + '"]');
          if (badge) {
            badge.textContent = data.value;
            badge.dataset.value = data.value;
            badge.classList.remove('bg-success', 'bg-secondary');
            badge.classList.add(data.value === 'OB' ? 'bg-success' : 'bg-secondary');
          }
          bootstrap.Modal.getInstance(obOtModal).hide();
        } catch (err) {
          showAlert('Failed to update OB/OT: ' + (err.message || ''), 'danger');
        }
      });

      function showAlert(message, type) {
        const el = document.getElementById('obOtAlert');
        el.className = 'alert alert-' + type;
        el.textContent = message;
      }
      @endcan
    });
    </script>
  @endpush
</x-app-layout>
