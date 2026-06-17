<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::orderBy('show_order')->get();
        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        return view('admin.offices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'main'       => 'nullable|string|max:255',
            'district'   => 'nullable|string|max:255',
            'show_order' => 'required|integer',
        ]);

        Office::create($request->only(['name', 'main', 'district', 'show_order']));

        return redirect()->route('admin.offices.index')->with('success', 'Office created successfully.');
    }

    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'main'       => 'nullable|string|max:255',
            'district'   => 'nullable|string|max:255',
            'show_order' => 'required|integer',
        ]);

        $office->update($request->only(['name', 'main', 'district', 'show_order']));

        return redirect()->route('admin.offices.index')->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('admin.offices.index')->with('success', 'Office deleted successfully.');
    }
}
