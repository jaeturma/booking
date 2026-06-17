<?php

namespace App\Http\Controllers;

use App\Models\Document;

class DocumentController extends Controller
{
    // GET /api/docs/{tracking_no}   (we'll assume 8-digit numeric)
    public function show(string $tracking_no)
    {
        abort_unless(preg_match('/^\d{7}$/', $tracking_no), 404);

        $doc = Document::with([
            'fromOffice:id,name',
            'toOffice:id,name',
            'forUser:id,name',
            'updates.office:id,name',
            'updates.user:id,name',
        ])->where('tracking_no', $tracking_no)->firstOrFail();

        // shape for the kiosk
        return response()->json([
            'title'       => $doc->title,
            'tracking_no' => $doc->tracking_no,
            'sender'      => $doc->sender_name,
            'date_filed'  => optional($doc->date_filed)->format('Y-m-d H:i'),
            'from_office' => optional($doc->fromOffice)->name,
            'to_office'   => optional($doc->toOffice)->name,
            'for_user'    => optional($doc->forUser)->name,
            'updates'     => $doc->updates->map(fn($u) => [
                'date'    => $u->occurred_at?->format('Y-m-d H:i'),
                'status'  => $u->status,
                'details' => $u->details,
            ])->values(),
        ]);
    }
}
