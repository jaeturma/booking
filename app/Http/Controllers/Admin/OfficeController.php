<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfficeController extends Controller
{
    public function index()
    {
        return view('admin.offices.index');
    }

    public function getData()
    {
        $canManage = auth()->user()->can('manage-offices-services');
        $query = Office::orderBy('show_order');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($office) use ($canManage) {
                if (!$canManage) {
                    return '<span class="text-muted">—</span>';
                }
                return '<div class="text-nowrap">'
                     . '<a href="' . route('admin.offices.edit', $office->id) . '" class="btn btn-sm btn-warning mr-1">'
                     . '<i class="fas fa-edit"></i> Edit</a>'
                     . '<form action="' . route('admin.offices.destroy', $office->id) . '" method="POST" style="display:inline;">'
                     . csrf_field() . method_field('DELETE')
                     . '<button type="submit" class="btn btn-sm btn-danger"'
                     . ' onclick="return confirm(\'Delete this office?\')"><i class="fas fa-trash"></i></button>'
                     . '</form>'
                     . '</div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        $this->authorize('manage-offices-services');
        return view('admin.offices.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-offices-services');
        $request->validate([
            'name'       => 'required|string|max:255',
            'main'       => 'nullable|string|max:255',
            'district'   => 'nullable|string|max:255',
            'group'      => 'nullable|string|max:100',
            'show_order' => 'nullable|integer',
        ]);

        Office::create($request->only(['name', 'main', 'district', 'group', 'show_order']));

        return redirect()->route('admin.offices.index')->with('success', 'Office created successfully.');
    }

    public function edit(Office $office)
    {
        $this->authorize('manage-offices-services');
        return view('admin.offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $this->authorize('manage-offices-services');
        $request->validate([
            'name'       => 'required|string|max:255',
            'main'       => 'nullable|string|max:255',
            'district'   => 'nullable|string|max:255',
            'group'      => 'nullable|string|max:100',
            'show_order' => 'nullable|integer',
        ]);

        $office->update($request->only(['name', 'main', 'district', 'group', 'show_order']));

        return redirect()->route('admin.offices.index')->with('success', 'Office updated successfully.');
    }

    public function destroy(Office $office)
    {
        $this->authorize('manage-offices-services');
        $office->delete();
        return redirect()->route('admin.offices.index')->with('success', 'Office deleted successfully.');
    }
}
