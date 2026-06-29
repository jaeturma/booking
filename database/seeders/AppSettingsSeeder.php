<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
        [
            'key' => 'ca_signatory_name',
            'value' => 'NORBERTO S. MANLANGIT, CE, MPA'
        ],
        [
            'key' => 'ca_signatory_position',
            'value' => 'Administrative Officer V'
        ],
        [
            'key' => 'ca_theme_color',
            'value' => '#000000'
        ],
        [
            'key' => 'ca_esign_path',
            'value' => 'images/settings/ca_esign-2479be98-3dfb-4f19-bcc4-00bac8b3e3b3.png'
        ],
        [
            'key' => 'login_logo_path',
            'value' => 'images/ddo_logo.png'
        ],
        [
            'key' => 'app_logo_path',
            'value' => 'images/ddo_logo.png'
        ],
        [
            'key' => 'kiosk_title',
            'value' => 'Self-Service Kiosk'
        ],
        [
            'key' => 'kiosk_footer',
            'value' => 'Schools Division of Davao de Oro | Department of Education'
        ]
        ] as $setting) {
            DB::table('app_settings')->updateOrInsert(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}