<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Office;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['office', 'subServices'])->orderBy('name')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $offices = Office::orderBy('show_order')->get();
        return view('admin.services.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'sub_services' => 'nullable|string',
        ]);

        $service = Service::create($request->only(['name', 'office_id']));
        $this->syncSubServices($service, $request->input('sub_services', ''));

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $service->load('subServices');
        $offices = Office::orderBy('show_order')->get();
        return view('admin.services.edit', compact('service', 'offices'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'sub_services' => 'nullable|string',
        ]);

        $service->update($request->only(['name', 'office_id']));
        $this->syncSubServices($service, $request->input('sub_services', ''));

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    private function syncSubServices(Service $service, ?string $subServices): void
    {
        $names = collect(preg_split('/\r\n|\r|\n/', $subServices ?? ''))
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique()
            ->values();

        $service->subServices()->whereNotIn('name', $names)->delete();

        foreach ($names as $name) {
            $service->subServices()->firstOrCreate(['name' => $name]);
        }
    }
}
