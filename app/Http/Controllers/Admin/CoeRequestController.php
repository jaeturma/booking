<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CoeRequestController extends Controller
{
    public function index()
    {
        $this->authorize('manage-transactions');

        return view('admin.coe-requests.index');
    }

    public function getData(Request $request)
    {
        $this->authorize('manage-transactions');

        $query = Booking::with(['user.office', 'subService'])
            ->whereHas('subService', fn ($q) => $q->where('name', 'COE Request'))
            ->latest();

        return DataTables::eloquent($query)
            ->setRowId(fn ($b) => 'coe-row-' . $b->id)
            ->addColumn('employee_name', fn ($b) => e($b->user->name ?? $b->guest_name ?? '—'))
            ->addColumn('employee_no', fn ($b) => e($b->user->employee_no ?? '—'))
            ->addColumn('district', fn ($b) => e(optional($b->user?->office)->district ?: '—'))
            ->addColumn('school_office', fn ($b) => e(optional($b->user?->office)->name ?: '—'))
            ->editColumn('purpose', fn ($b) => e($b->purpose ?? '—'))
            ->editColumn('created_at', fn ($b) => $b->created_at?->format('Y-m-d H:i'))
            ->addColumn('status', function ($b) {
                return $b->is_validated
                    ? '<span class="badge badge-success">Validated</span>'
                    : '<span class="badge badge-warning">Pending</span>';
            })
            ->addColumn('actions', function ($b) {
                return '<div class="text-nowrap">'
                     . '<a href="'.route('admin.coe-requests.print-fresh', $b).'" target="_blank" class="btn btn-success btn-sm mr-1">Fresh</a>'
                     . '<a href="'.route('admin.coe-requests.print-esign', $b).'" target="_blank" class="btn btn-primary btn-sm">E-Sign</a>'
                     . '</div>';
            })
            ->filterColumn('employee_name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->whereHas('user', fn ($uq) => $uq->where('name', 'like', "%{$keyword}%"))
                      ->orWhere('guest_name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('district', function ($query, $keyword) {
                $query->whereHas('user.office', fn ($oq) => $oq->where('district', 'like', "%{$keyword}%"));
            })
            ->filterColumn('school_office', function ($query, $keyword) {
                $query->whereHas('user.office', fn ($oq) => $oq->where('name', 'like', "%{$keyword}%"));
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
