<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends Controller
{
    public function index()
    {
        return view('admin.surveys.index');
    }

    public function getData(Request $request)
    {
        $query = Survey::with(['office', 'service', 'responses.question'])->latest();

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', fn($s) => $s->created_at?->format('Y-m-d H:i'))
            ->addColumn('client', function ($s) {
                $type = $s->customer_type ? ucfirst($s->customer_type) : null;
                if ($s->employee_no) {
                    return '<strong>' . e($s->employee_no) . '</strong>'
                         . ($type ? '<br><small class="text-muted">' . e($type) . '</small>' : '');
                }
                return $type ?? '—';
            })
            ->addColumn('office_name', fn($s) => e($s->office->name ?? '—'))
            ->addColumn('service_name', fn($s) => e($s->service->name ?? '—'))
            ->addColumn('demographics', function ($s) {
                $parts = array_filter([
                    $s->age    ? 'Age: ' . $s->age         : null,
                    $s->gender ? ucfirst(str_replace('_', ' ', $s->gender)) : null,
                ]);
                return implode(' · ', $parts) ?: '—';
            })
            ->addColumn('response_count', fn($s) => $s->responses->count())
            ->addColumn('actions', function ($s) {
                return '<div class="text-nowrap">'
                    . '<button class="btn btn-sm btn-info js-view-responses mr-1"'
                    . ' data-id="' . $s->id . '"'
                    . ' data-url="' . route('admin.surveys.responses', $s->id) . '">'
                    . '<i class="fas fa-list-ul"></i> Responses'
                    . '</button>'
                    . '</div>';
            })
            ->filterColumn('office_name', fn($q, $k) => $q->whereHas('office', fn($oq) => $oq->where('name', 'like', "%{$k}%")))
            ->filterColumn('service_name', fn($q, $k) => $q->whereHas('service', fn($sq) => $sq->where('name', 'like', "%{$k}%")))
            ->filterColumn('client', function ($q, $k) {
                $q->where('employee_no', 'like', "%{$k}%")
                  ->orWhere('customer_type', 'like', "%{$k}%");
            })
            ->rawColumns(['client', 'actions'])
            ->make(true);
    }

    public function responses($id)
    {
        $survey = Survey::with(['responses.question', 'office', 'service', 'booking'])
            ->findOrFail($id);

        return response()->json([
            'survey' => [
                'id'           => $survey->id,
                'date'         => $survey->created_at?->format('M d, Y h:i A'),
                'office'       => $survey->office->name    ?? '—',
                'service'      => $survey->service->name   ?? '—',
                'employee_no'  => $survey->employee_no     ?? '—',
                'customer_type'=> $survey->customer_type   ? ucfirst($survey->customer_type) : '—',
                'age'          => $survey->age             ?? '—',
                'gender'       => $survey->gender          ? ucfirst(str_replace('_', ' ', $survey->gender)) : '—',
                'contact'      => $survey->contact         ?? '—',
                'requested_coa'=> $survey->requested_coa   ? 'Yes' : 'No',
                'booking_code' => $survey->booking->booking_code ?? '—',
            ],
            'responses' => $survey->responses
                ->sortBy(fn($r) => $r->question->order ?? 0)
                ->map(fn($r) => [
                    'question' => $r->question->question ?? '—',
                    'answer'   => $r->answer,
                ])->values(),
        ]);
    }
}
