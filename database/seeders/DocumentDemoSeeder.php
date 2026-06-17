<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Document, DocumentTracking, Office};
use Carbon\Carbon;

class DocumentDemoSeeder extends Seeder
{
    public function run(): void
    {
        $from = Office::firstOrCreate(['name' => 'Records Section']);
        $to   = Office::firstOrCreate(['name' => 'Treasury Office']);

        $doc = Document::updateOrCreate(
            ['tracking_no' => '112233'],
            [
                'title' => 'Purchase Request - Office Supplies',
                'sender_name' => 'Maria Santos',
                'date_filed' => Carbon::parse('2025-08-15 09:30'),
                'from_office_id' => $from->id,
                'to_office_id' => $to->id,
                'latest_status' => 'Released',
            ]
        );

        $events = [
            ['2025-08-15 09:30', 'Document Received', 'Received at the Records Section by John Arzaga', $from->id],
            ['2025-08-16 13:00', 'Processing',        'Reviewed by Treasury Office staff', $to->id],
            ['2025-08-18 10:00', 'For Approval',      'Pending approval by Mayor’s Office', null],
            ['2025-08-20 15:15', 'Released',          'Released by Information Desk clerk', null],
        ];

        foreach ($events as [$ts, $status, $details, $officeId]) {
            DocumentTracking::updateOrCreate(
                ['document_id' => $doc->id, 'occurred_at' => Carbon::parse($ts), 'status' => $status],
                ['details' => $details, 'office_id' => $officeId]
            );
        }
    }
}
