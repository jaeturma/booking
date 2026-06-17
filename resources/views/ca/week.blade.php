<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $officeName }}</h2>
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
                  <td>
                    @if ($c->printed_at)
                      <span class="badge bg-success">Yes</span>
                    @else
                      <span class="badge bg-warning">No</span>
                    @endif
                  </td>
                  <td class="text-end">
                    <a href="{{ route('certificates.print-preview', $c) }}" target="_blank" class="btn btn-primary btn-flat">Print</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
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
  @endpush
</x-app-layout>
