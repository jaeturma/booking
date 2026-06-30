<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingValidation;
use App\Models\Office;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class BookingAdminController extends Controller
{
    // superadmin (ITO/Superadmin) or admin (Admin Office) can see all bookings
    private function isPrivileged($user): bool
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function index()
    {
        $user = auth()->user();
        $isPrivileged = $this->isPrivileged($user);
        $offices = $isPrivileged ? Office::whereNotNull('show_order')->orderBy('show_order')->get(['id', 'name', 'group']) : collect();
        return view('bookings.index', compact('isPrivileged', 'offices'));
    }

    public function getIndexData(Request $request)
    {
        $user = auth()->user();
        $isPrivileged = $this->isPrivileged($user);
        $officeFilter = ($isPrivileged && $request->filled('office')) ? (int) $request->input('office') : null;

        if ($officeFilter) {
            $query = Booking::with(['user', 'service', 'office'])->where('office_id', $officeFilter);
        } elseif ($isPrivileged) {
            $query = Booking::with(['user', 'service', 'office']);
        } elseif ($user->office_id == 540 || optional($user->office)->name === 'SGOD') {
            $query = Booking::with(['user', 'service', 'office'])->whereBetween('office_id', [11, 16]);
        } else {
            $query = Booking::with(['user', 'service', 'office'])->where('office_id', $user->office_id);
        }

        $this->applyDateFilter($query, $request->input('filter', 'today'));

        return $this->buildBookingDataTable($query, $user);
    }

    private function applyDateFilter($query, string $filter): void
    {
        match ($filter) {
            'week'  => $query->whereBetween('created_at', [
                            Carbon::now()->startOfWeek(Carbon::MONDAY),
                            Carbon::now()->endOfWeek(Carbon::SUNDAY)->endOfDay(),
                        ]),
            'month' => $query->whereMonth('created_at', Carbon::now()->month)
                             ->whereYear('created_at', Carbon::now()->year),
            'year'  => $query->whereYear('created_at', Carbon::now()->year),
            default => $query->whereDate('created_at', Carbon::today()),
        };
    }

    private function buildBookingDataTable($query, $user)
    {
        $isSuperAdmin  = $user->hasRole('superadmin');   // ITO/Superadmin — full access
        $isAdmin       = $user->hasRole('admin');         // Admin Office — see all, validate own
        $isValidator   = $user->hasRole('validator');     // Own office only
        $userOfficeId  = $user->office_id;
        $canHide       = $isSuperAdmin || $isAdmin;
        $canValidateAny = $isSuperAdmin;                  // only superadmin can validate any office
        $canValidateOwn = $isAdmin || $isValidator;       // validate own office only

        return DataTables::eloquent($query)
            ->setRowId(fn($b) => 'booking-row-' . $b->id)
            ->addColumn('client', function ($b) {
                if ($b->user) {
                    return '<span class="fw-medium">' . e($b->user->name) . '</span>'
                         . '<div class="small text-muted">' . e($b->user->employee_no) . '</div>';
                } elseif ($b->guest_name) {
                    return '<span class="badge text-bg-secondary">Guest</span>';
                }
                return '<span class="text-muted">—</span>';
            })
            ->addColumn('service_office', function ($b) {
                return '<div>' . e($b->service->name ?? '—') . '</div>'
                     . '<div class="small text-muted">' . e($b->office->name ?? '') . '</div>';
            })
            ->editColumn('created_at', fn($b) => $b->created_at?->format('Y-m-d H:i'))
            ->addColumn('status', function ($b) {
                $html = $b->is_validated
                    ? '<span class="badge text-bg-success">Validated</span>'
                    : '<span class="badge text-bg-warning text-dark">Pending</span>';
                if ($b->is_hidden) {
                    $html .= ' <span class="badge text-bg-secondary">Hidden</span>';
                }
                if ($b->is_survey) {
                    $html .= ' <span class="badge text-bg-info">CSM Done</span>';
                }
                return $html;
            })
            ->addColumn('actions', function ($b) use ($canHide, $canValidateAny, $canValidateOwn, $userOfficeId) {
                $html = '';
                if ($canHide) {
                    if (!$b->is_hidden) {
                        $html .= '<button class="js-hide btn btn-outline-secondary btn-sm me-1"'
                               . ' data-action="' . route('bookings.hide', $b) . '"'
                               . ' data-row="#booking-row-' . $b->id . '"'
                               . ' data-id="' . $b->id . '">Hide</button>';
                    } else {
                        $html .= '<button class="js-unhide btn btn-outline-secondary btn-sm me-1"'
                               . ' data-action="' . route('bookings.unhide', $b) . '"'
                               . ' data-row="#booking-row-' . $b->id . '"'
                               . ' data-id="' . $b->id . '">Unhide</button>';
                    }
                }
                $canValidateRow = $canValidateAny || ($canValidateOwn && $b->office_id == $userOfficeId);
                if ($canValidateRow) {
                    if (!$b->is_validated) {
                        $html .= '<button class="js-validate btn btn-primary btn-sm"'
                               . ' data-action="' . route('bookings.validate', $b) . '"'
                               . ' data-row="#booking-row-' . $b->id . '"'
                               . ' data-code="' . e($b->booking_code) . '">Validate</button>';
                    } else {
                        $html .= '<button class="btn btn-success btn-sm" disabled>Validated</button>';
                    }
                }
                return $html;
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

    public function validateBooking(Request $request, Booking $booking)
    {
        $user = $request->user();

        if ($user->hasRole('superadmin')) {
            // ITO/Superadmin — can validate any booking
        } elseif ($user->hasRole('admin')) {
            // Admin Office — can only validate their own office's bookings
            if ($booking->office_id !== $user->office_id) {
                return $this->respond($request, 403, 'Admin Office can only validate its own office bookings.');
            }
            if ($booking->is_hidden) {
                return $this->respond($request, 403, 'This booking is hidden.');
            }
        } elseif ($user->hasRole('validator')) {
            // Regular office validator — own office only
            if (!$user->office_id) return $this->respond($request, 403, 'You must be assigned to an office.');
            if ($booking->office_id !== $user->office_id) return $this->respond($request, 403, 'This booking belongs to another office.');
            if ($booking->is_hidden) return $this->respond($request, 403, 'This booking is hidden.');
        } else {
            return $this->respond($request, 403, 'Unauthorized.');
        }
        if ($booking->is_validated) {
            return $this->respond($request, 409, 'Booking already validated.');
        }

        $booking->update(['is_validated' => true]);

        BookingValidation::create([
            'booking_id'   => $booking->id,
            'validated_by' => $user->id,
            'validated_at' => now(),
        ]);

        return $this->respond($request, 200, "Booking {$booking->booking_code} validated.", ['ok' => true]);
    }

    public function hide(Request $request, Booking $booking)
    {
        $this->authorizeAdmin($request);
        $booking->update(['is_hidden' => true]);
        return $this->respond($request, 200, 'Hidden', ['hidden' => true]);
    }

    public function unhide(Request $request, Booking $booking)
    {
        $this->authorizeAdmin($request);
        $booking->update(['is_hidden' => false]);
        return $this->respond($request, 200, 'Visible', ['hidden' => false]);
    }

    private function authorizeAdmin(Request $request): void
    {
        if (!$request->user()->hasAnyRole(['superadmin', 'admin'])) {
            abort(403, 'Unauthorized.');
        }
    }

    private function respond(Request $request, int $status, string $message, array $extra = [])
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message] + $extra, $status);
        }
        return back()->with($status >= 400 ? 'error' : 'success', $message);
    }
}
