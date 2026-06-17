<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Certificate Details
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm border rounded-lg p-5">

        <!-- Certificate Info Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <tbody>
              <tr>
                <th class="w-50">Certificate Number</th>
                <td>{{ $certificate->certificate_number }}</td>
              </tr>
              <tr>
                <th>Guest Name</th>
                <td>{{ $certificate->guest_name }}</td>
              </tr>
              <tr>
                <th>Service</th>
                <td>{{ $certificate->service->name ?? '' }}</td>
              </tr>
              <tr>
                <th>Office</th>
                <td>{{ $certificate->office->name ?? '' }}</td>
              </tr>
              <tr>
                <th>Issued At</th>
                <td>{{ $certificate->issued_at->format('F d, Y h:i A') }}</td>
              </tr>
              <tr>
                <th>Purpose</th>
                <td>{{ $certificate->purpose }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Action Buttons -->
          <div class="mt-8 flex flex-wrap gap-3">
          <a href="{{ route('certificates.print-preview', $certificate) }}" 
             target="_blank"
             class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 focus:outline-none">
            🖨 Print
          </a>

          <a href="{{ route('certificates.index') }}" 
             class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg shadow hover:bg-gray-700 focus:outline-none">
            ← Back to List
          </a>
        </div>
        
      </div>
    </div>
  </div>
</x-app-layout>
