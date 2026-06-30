<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-lg text-gray-800 leading-tight">Transaction Booking</h2>
  </x-slot>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if($isPrivileged)
  <script>window.__offices = {!! json_encode($offices->map(fn($o) => ['id' => $o->id, 'name' => $o->name, 'group' => $o->group])->values()) !!};</script>
  @endif

  @push('styles')
    @include('partials.vendor-dt-bs5-styles')
    <style>
      /* Keep filter div as a flex row so all controls stay on one line */
      #bookingsTable_filter {
        float: none !important;
        text-align: left !important;
        display: flex !important;
        align-items: center;
        gap: 0.4rem;
        flex-wrap: wrap;
      }
      #bookingsTable_filter label { margin-bottom: 0; white-space: nowrap; }
      #bookingsTable_length label { margin-bottom: 0; }
    </style>
  @endpush

  <div class="py-5">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm ring-1 ring-gray-200 sm:rounded-lg overflow-hidden">

        {{-- Colored header strip --}}
        <div class="bg-blue-600 px-4 py-2 flex items-center gap-2">
          <svg class="w-4 h-4 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
          </svg>
          <span class="text-sm font-semibold text-white tracking-wide">Booking Queue</span>
        </div>

        <div class="p-4">
          <div class="table-responsive">
            <table id="bookingsTable" class="table table-sm table-striped table-hover table-bordered align-middle w-100">
              <thead class="table-primary">
                <tr>
                  <th>Code</th>
                  <th>Client</th>
                  <th>Service / Office</th>
                  <th>Date/Time</th>
                  <th>Status</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  @push('scripts')
    @include('partials.vendor-dt-bs5-scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      let activeDate   = 'today';
      let activeOffice = '';
      const baseUrl    = '{{ route("bookings.data") }}';

      function buildUrl() {
        let url = baseUrl + '?filter=' + activeDate;
        if (activeOffice) url += '&office=' + activeOffice;
        return url;
      }

      $('#bookingsTable').on('init.dt', function () {
        const filterDiv = $('#bookingsTable_filter');

        // Build date select
        const dateSelect = $('<select class="form-select form-select-sm" style="width:auto">'
          + '<option value="today">Today</option>'
          + '<option value="week">This Week</option>'
          + '<option value="month">This Month</option>'
          + '<option value="year">This Year</option>'
          + '</select>');
        dateSelect.on('change', function () {
          activeDate = this.value;
          window.__dt['bookingsTable'].ajax.url(buildUrl()).load();
        });

        // Build office select (privileged users only)
        let officeSelect = null;
        if (window.__offices && window.__offices.length) {
          const groups = {}, ungrouped = [];
          window.__offices.forEach(function (o) {
            if (o.group) { (groups[o.group] = groups[o.group] || []).push(o); }
            else { ungrouped.push(o); }
          });
          let opts = '<option value="">All Offices</option>';
          Object.keys(groups).sort().forEach(function (g) {
            opts += '<optgroup label="' + g + '">';
            groups[g].forEach(o => opts += '<option value="' + o.id + '">' + o.name + '</option>');
            opts += '</optgroup>';
          });
          ungrouped.forEach(o => opts += '<option value="' + o.id + '">' + o.name + '</option>');

          officeSelect = $('<select class="form-select form-select-sm" style="width:auto">' + opts + '</select>');
          officeSelect.on('change', function () {
            activeOffice = this.value;
            window.__dt['bookingsTable'].ajax.url(buildUrl()).load();
          });
        }

        // Insert: office (if any), then date, then existing search — left to right
        // prepend() inserts before existing content, so add in reverse display order
        filterDiv.prepend(dateSelect);
        if (officeSelect) filterDiv.prepend(officeSelect);
      });
    });
    </script>

    @include('partials.dt-init', [
      'tableId'        => 'bookingsTable',
      'orderCol'       => 3,
      'noOrderTargets' => [],
      'ajaxUrl'        => route('bookings.data') . '?filter=today',
      'dom'            => "<'d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2'<''l><'d-flex align-items-center gap-2 flex-wrap'f>>rt<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      'columns'        => [
        ['data' => 'booking_code',   'name' => 'booking_code'],
        ['data' => 'client',         'name' => 'client',        'orderable' => false],
        ['data' => 'service_office', 'name' => 'service_office','orderable' => false, 'searchable' => false],
        ['data' => 'created_at',     'name' => 'created_at'],
        ['data' => 'status',         'name' => 'status',        'orderable' => false, 'searchable' => false],
        ['data' => 'actions',        'name' => 'actions',       'orderable' => false, 'searchable' => false],
      ],
    ])
    @include('partials.validate-handler')
    @include('partials.visibility-handler')
  @endpush
</x-app-layout>
