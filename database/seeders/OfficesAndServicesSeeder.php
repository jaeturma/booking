<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;
use App\Models\Service;
use App\Models\SubService;

class OfficesAndServicesSeeder extends Seeder
{
    public function run(): void
    {
        // show_order drives kiosk display order; null = internal/not shown on kiosk
        $data = [
            ‘SDS Office’ => [
                ‘show_order’ => 1,
                ‘services’   => [‘Document Signing’, ‘Appointment Request’, ‘Memorandum Inquiry’, ‘Other Request/Inquiry’],
            ],
            ‘CID’ => [
                ‘show_order’ => 2,
                ‘services’   => [‘Request for Learning Materials’, ‘Teacher Training / LAC Session’, ‘Curriculum Advisory’, ‘Other Request/Inquiry’],
            ],
            ‘SGOD’ => [
                ‘show_order’ => 3,
                ‘services’   => [‘School Report Submission’, ‘DRRM Concern’, ‘SBM Advisory’, ‘Other Request/Inquiry’],
            ],
            ‘Administrative Division’ => [
                ‘show_order’ => 4,
                ‘services’   => [‘Supply / Materials Request’, ‘Property Management’, ‘General Administrative Concern’, ‘Other Request/Inquiry’],
            ],
            ‘HRMD’ => [
                ‘show_order’ => 5,
                ‘services’   => [‘Service Record Request’, ‘Leave Application’, ‘Certificate of Employment’, ‘Personnel File Request’, ‘Other Request/Inquiry’],
            ],
            ‘Budget and Finance’ => [
                ‘show_order’ => 6,
                ‘services’   => [‘Financial Inquiry’, ‘Cash Advance Request’, ‘Reimbursement / Liquidation’, ‘Other Request/Inquiry’],
            ],
            ‘Records Section’ => [
                ‘show_order’ => 7,
                ‘services’   => [‘Document Request’, ‘Certification Issuance’, ‘Other Request/Inquiry’],
            ],
            ‘ICT Unit’ => [
                ‘show_order’ => 8,
                ‘services’   => [‘Technical Support’, ‘System / Network Access’, ‘Other Request/Inquiry’],
            ],
            ‘Legal Unit’ => [
                ‘show_order’ => 9,
                ‘services’   => [‘Legal Consultation’, ‘Other Request/Inquiry’],
            ],
            ‘Planning and Research’ => [
                ‘show_order’ => 10,
                ‘services’   => [‘Data / Statistical Request’, ‘Annual Planning Concern’, ‘Other Request/Inquiry’],
            ],
        ];

        foreach ($data as $officeName => $config) {
            $office = Office::updateOrCreate(
                [‘name’ => $officeName],
                [‘show_order’ => $config[‘show_order’], ‘district’ => ‘Division Office’]
            );
            foreach ($config[‘services’] as $s) {
                $service = Service::firstOrCreate([‘office_id’ => $office->id, ‘name’ => $s]);
                $this->seedOtherRequestSubServices($service);
            }
        }
    }

    private function seedOtherRequestSubServices(Service $service): void
    {
        if (!preg_match('/other\s+(request|requests|inquiry|inquiries)/i', $service->name)) {
            return;
        }

        foreach (['General inquiry', 'Document follow-up', 'Request for information', 'Other concern'] as $name) {
            SubService::firstOrCreate(['service_id' => $service->id, 'name' => $name]);
        }
    }
}
