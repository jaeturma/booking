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
        $years = Survey::selectRaw('YEAR(created_at) as y')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderByDesc('y')
            ->pluck('y');

        return view('admin.surveys.index', ['years' => $years]);
    }

    private function applyDateFilter($query, Request $request)
    {
        if ($from = $request->input('from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->input('to')) {
            $query->whereDate('created_at', '<=', $to);
        }
        return $query;
    }

    public function getData(Request $request)
    {
        $query = $this->applyDateFilter(
            Survey::with(['office', 'service', 'responses.question']),
            $request
        )->latest();

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

    // GET /admin/surveys/export — .xlsx following the MS Forms "Client Satisfaction Measurement" template
    public function export(Request $request)
    {
        $headers = [
            'ID', 'Start time', 'Completion time', 'Email', 'Name', 'Last modified time',
            'Age', 'Sex', 'Customer Type',
            'Office transacted with',
            'Service availed - SDS',
            'Service availed - ASDS',
            'Office transacted with2',
            'Service availed -  Cash, General Services, Procurement',
            'Service availed - Personnel',
            'Service availed - Property and Supply',
            'Service availed - Records',
            'Office transacted with3',
            'Service availed - CID',
            'Office transacted with4',
            'Service availed - Accounting, Budget',
            'Service availed - ICT',
            'Service availed - Legal',
            'Office transacted with5',
            'Service availed - SGOD',
            'Service availed - SGOD (Private school-related)',
            "Are you aware of the Citizen's Charter - document of the SDO services and requirements?",
            'Did you see the SDO Citizen\'s Charter (online or posted in the office)?',
            'Did you use the SDO Citizen\'s Charter as a guide for the service you availed',
            'SQD1 - I spent an acceptable amount of time to complete my transaction (Responsiveness)',
            "SQD2 - The office accurately informed and followed the transaction's requirements and steps (Reliability)",
            'SQD3 - My transaction (including steps and payment) was simple and convenient (Access and Facilities)',
            'SDQ4 - I easily found information about my transaction from the office or its website (Communication)',
            'SQD5 - I paid an acceptable amount of fees for my transaction (Costs',
            'SQD6 - I am confident my transaction was secure (Integrity)',
            "SQD7 - The office's support was quick to respond (Assurance)",
            'SQD8 - I got what I needed from the government office (Outcome)',
            'Remarks',
        ];

        $surveys = $this->applyDateFilter(
            Survey::with(['office', 'service', 'subService', 'booking.user', 'responses.question']),
            $request
        )->orderBy('created_at')->get();

        $rows = [];
        foreach ($surveys as $i => $s) {
            $row = array_fill(0, count($headers), '');

            $row[0] = $i + 1;
            $row[1] = $s->created_at?->format('Y-m-d H:i:s') ?? '';
            $row[2] = $s->updated_at?->format('Y-m-d H:i:s') ?? '';
            $row[3] = $s->booking?->user?->email ?: 'anonymous';
            $row[4] = $s->booking?->guest_name ?: ($s->booking?->user?->name ?? '');
            $row[5] = $s->updated_at?->format('Y-m-d H:i:s') ?? '';
            $row[6] = $s->age ?? '';
            $row[7] = $s->gender ?? '';
            $row[8] = $s->customer_type ?? '';

            $officeName  = $s->office->name ?? '';
            $main        = trim((string) ($s->office->main ?? ''));
            $group       = ($main !== '' && $main !== '1') ? $main : null;
            $serviceName = $s->service->name ?? '';
            if ($s->subService?->name) {
                $serviceName .= ' - ' . $s->subService->name;
            }

            if ($group === 'Admin') {
                $row[12] = $officeName;
                if (str_contains($officeName, 'Personnel'))                 $row[14] = $serviceName;
                elseif (str_contains($officeName, 'Property and Supply'))   $row[15] = $serviceName;
                elseif (str_contains($officeName, 'Records'))               $row[16] = $serviceName;
                else                                                        $row[13] = $serviceName; // Cash, General Services, Procurement
            } elseif ($group === 'CID') {
                $row[17] = $officeName;
                $row[18] = $serviceName;
            } elseif ($group === 'Finance') {
                $row[19] = $officeName;
                $row[20] = $serviceName;
            } elseif ($group === 'SGOD') {
                $row[23] = $officeName;
                $row[24] = $serviceName;
            } else {
                $row[9] = $officeName;
                if (str_contains($officeName, 'ICT'))            $row[21] = $serviceName;
                elseif (str_contains($officeName, 'Legal'))      $row[22] = $serviceName;
                elseif (str_contains($officeName, 'Assistant'))  $row[11] = $serviceName; // ASDS
                else                                             $row[10] = $serviceName; // SDS
            }

            $row[26] = $s->cc_aware ?? '';
            $row[27] = $s->cc_see ?? '';
            $row[28] = $s->cc_used ?? '';

            foreach ($s->responses as $r) {
                $order = $r->question->order ?? 0;
                if ($order >= 1 && $order <= 8) {
                    $row[29 + $order - 1] = $this->sqdLabel($r->answer);
                }
            }

            $row[37] = $s->remarks ?? '';
            $rows[] = $row;
        }

        $path = $this->buildXlsx($headers, $rows);

        return response()
            ->download($path, 'Client Satisfaction Measurement - ' . now()->format('Y-m-d') . '.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])
            ->deleteFileAfterSend(true);
    }

    private function sqdLabel(?string $answer): string
    {
        return match ($answer) {
            '5' => 'Strongly Agree (5)',
            '4' => 'Agree (4)',
            '3' => 'Neither Agree nor Disagree (3)',
            '2', 'Disagree (2)' => 'Disagree (2)',
            '1' => 'Strongly Disagree (1)',
            '0' => 'Not Applicable',
            default => $answer ?? '',
        };
    }

    // Minimal single-sheet .xlsx writer (inline strings) — avoids a spreadsheet dependency
    private function buildXlsx(array $headers, array $rows): string
    {
        $colRef = function (int $i): string {
            $ref = '';
            $i++;
            while ($i > 0) {
                $m = ($i - 1) % 26;
                $ref = chr(65 + $m) . $ref;
                $i = intdiv($i - 1, 26);
            }
            return $ref;
        };

        $cell = function (int $c, int $r, $v) use ($colRef): string {
            $ref = $colRef($c) . $r;
            if (is_int($v) || is_float($v) || (is_string($v) && $v !== '' && preg_match('/^-?\d+(\.\d+)?$/', $v) && strlen($v) < 12)) {
                return '<c r="' . $ref . '"><v>' . $v . '</v></c>';
            }
            if ($v === '' || $v === null) {
                return '';
            }
            $t = htmlspecialchars((string) $v, ENT_XML1 | ENT_QUOTES, 'UTF-8');
            return '<c r="' . $ref . '" t="inlineStr"><is><t xml:space="preserve">' . $t . '</t></is></c>';
        };

        $sheetRows = '';
        $allRows = array_merge([$headers], $rows);
        foreach ($allRows as $ri => $row) {
            $r = $ri + 1;
            $cells = '';
            foreach ($row as $ci => $v) {
                $cells .= $cell($ci, $r, $v);
            }
            $sheetRows .= '<row r="' . $r . '">' . $cells . '</row>';
        }

        $sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<sheetData>' . $sheetRows . '</sheetData></worksheet>';

        $workbookXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"'
            . ' xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            . '<sheets><sheet name="Form1" sheetId="1" r:id="rId1"/></sheets></workbook>';

        $workbookRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            . '</Relationships>';

        $rootRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            . '</Relationships>';

        $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            . '<Default Extension="xml" ContentType="application/xml"/>'
            . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            . '</Types>';

        $path = tempnam(sys_get_temp_dir(), 'csm');
        $zip = new \ZipArchive();
        $zip->open($path, \ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', $contentTypes);
        $zip->addFromString('_rels/.rels', $rootRels);
        $zip->addFromString('xl/workbook.xml', $workbookXml);
        $zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRels);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheetXml);
        $zip->close();

        return $path;
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
                'remarks'      => $survey->remarks         ?? '—',
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
