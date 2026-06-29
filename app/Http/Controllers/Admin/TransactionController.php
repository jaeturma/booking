<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transactions.index');
    }

    public function getData(Request $request)
    {
        $user       = auth()->user();
        $canManage  = $user->can('manage-transactions');

        // All admin-panel roles see all transactions
        $query = Booking::with(['user', 'service', 'office'])->latest();

        return DataTables::eloquent($query)
            ->setRowId(fn($b) => 'booking-row-' . $b->id)
            ->addColumn('client', function ($b) {
                if ($b->user) {
                    return '<strong>' . e($b->user->name) . '</strong>'
                         . '<br><small class="text-muted">' . e($b->user->employee_no) . '</small>';
                } elseif ($b->guest_name) {
                    return '<span class="badge badge-secondary">Guest</span>';
                }
                return '—';
            })
            ->addColumn('service_office', function ($b) {
                return e($b->service->name ?? '—')
                     . '<br><small class="text-muted">' . e($b->office->name ?? '') . '</small>';
            })
            ->editColumn('created_at', fn($b) => $b->created_at?->format('Y-m-d H:i'))
            ->addColumn('status', function ($b) {
                $html = $b->is_validated
                    ? '<span class="badge badge-success">Validated</span>'
                    : '<span class="badge badge-warning">Pending</span>';
                if ($b->is_hidden) $html .= ' <span class="badge badge-secondary">Hidden</span>';
                if ($b->is_survey) $html .= ' <span class="badge badge-info">CSM Done</span>';
                return $html;
            })
            ->addColumn('actions', function ($b) use ($canManage, $user) {
                if (!$canManage) {
                    return '<span class="text-muted">—</span>';
                }
                $html = '';
                if ($user->hasRole('admin')) {
                    if (!$b->is_hidden) {
                        $html .= '<button class="js-hide btn btn-sm btn-outline-secondary mr-1"'
                               . ' data-action="' . route('bookings.hide', $b) . '"'
                               . ' data-id="' . $b->id . '">Hide</button>';
                    } else {
                        $html .= '<button class="js-unhide btn btn-sm btn-outline-secondary mr-1"'
                               . ' data-action="' . route('bookings.unhide', $b) . '"'
                               . ' data-id="' . $b->id . '">Unhide</button>';
                    }
                }
                if (!$b->is_validated) {
                    $html .= '<button class="js-validate btn btn-sm btn-primary"'
                           . ' data-action="' . route('bookings.validate', $b) . '"'
                           . ' data-code="' . e($b->booking_code) . '">Validate</button>';
                } else {
                    $html .= '<button class="btn btn-sm btn-secondary" disabled>Validated</button>';
                }
                return '<div class="text-nowrap">' . $html . '</div>';
            })
            ->filterColumn('client', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->whereHas('user', function ($uq) use ($keyword) {
                        $uq->where('name', 'like', "%{$keyword}%")
                           ->orWhere('employee_no', 'like', "%{$keyword}%");
                    })->orWhere('guest_name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('service_office', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->whereHas('service', function ($sq) use ($keyword) {
                        $sq->where('name', 'like', "%{$keyword}%");
                    })->orWhereHas('office', function ($oq) use ($keyword) {
                        $oq->where('name', 'like', "%{$keyword}%");
                    });
                });
            })
            ->rawColumns(['client', 'service_office', 'status', 'actions'])
            ->make(true);
    }
}
