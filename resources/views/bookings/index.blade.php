<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Bookings @if(!empty($officeName)) <span class="ml-2 text-sm text-gray-500">— {{ $officeName }}</span> @endif
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
          <table id="bookingsTable" class="table table-sm table-striped table-hover table-bordered align-middle w-100">
            <thead class="table-light">
              <tr>
                <th>Code</th>
                <th>Client</th>
                <th>Service</th>
                <th>Date/Time</th>
                <th>Status</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings as $b)
                <tr id="booking-row-{{ $b->id }}">
                  <td class="fw-semibold">{{ $b->booking_code }}</td>
                  <td>
                        @if($b->user)
                            <span class="text-body">{{ $b->user->name }}</span>
                            <div class="small text-muted">{{ $b->user->employee_no }}</div>
                        @elseif($b->guest_name)
                            <span class="badge text-bg-secondary">Guest</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                  </td>
                  <td>
                        <div class="text-body">{{ $b->service->name ?? '—' }}</div>
                        <div class="small text-muted">{{ $b->office->name ?? '' }}</div>
                  </td>
                  <td data-order="{{ optional($b->created_at)->timestamp }}">{{ $b->created_at?->format('Y-m-d H:i') }}</td>
                  <td>
                        @if($b->is_validated)
                            <span class="badge text-bg-success">Validated</span>
                        @else
                            <span class="badge text-bg-warning text-dark">Pending</span>
                        @endif

                        @if($b->is_hidden)
                            <span class="badge text-bg-secondary ms-1">Hidden</span>
                        @endif

                        @if($b->is_survey)
                            <span class="badge text-bg-info ms-1">CSM Done</span>
                        @endif
                  </td>
                  <td class="text-end">
                    {{-- Admin-only Hide/Unhide --}}
                    @role('admin')
                        @if(!$b->is_hidden)
                            <button
                                class="js-hide btn btn-outline-secondary btn-sm me-1"
                                data-action="{{ route('bookings.hide', $b) }}"
                                data-row="#booking-row-{{ $b->id }}"
                                data-id="{{ $b->id }}"
                            >Hide</button>
                        @else
                            <button
                                class="js-unhide btn btn-outline-secondary btn-sm me-1"
                                data-action="{{ route('bookings.unhide', $b) }}"
                                data-row="#booking-row-{{ $b->id }}"
                                data-id="{{ $b->id }}"
                            >Unhide</button>
                        @endif
                    @endrole

                    {{-- Validate stays as before --}}
                    @if(!$b->is_validated)
                        <button
                            class="js-validate btn btn-primary btn-sm"
                            data-action="{{ route('bookings.validate', $b) }}"
                            data-row="#booking-row-{{ $b->id }}"
                            data-code="{{ $b->booking_code }}"
                        >Validate</button>
                    @else
                        <button class="btn btn-outline-secondary btn-sm" disabled>Validated</button>
                    @endif
                </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- IMPORTANT: do not render Laravel pagination here when using DataTables --}}
      </div>
    </div>
  </div>

  @push('scripts')
    @include('partials.vendor-dt-bs5-scripts')
    {{-- Reusable DT init (set your table id + sort column index) --}}
    @include('partials.dt-init', [
      'tableId' => 'bookingsTable',
      'orderCol' => 4,           // Created column
      'noOrderTargets' => [-1],  // Action column not orderable
      'placeholder' => 'Search bookings…'
    ])
    {{-- Generic SweetAlert validate handler (uses .js-validate buttons) --}}
    @include('partials.validate-handler')
  @endpush
</x-app-layout>
