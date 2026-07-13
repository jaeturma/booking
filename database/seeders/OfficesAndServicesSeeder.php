<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficesAndServicesSeeder extends Seeder
{
    public function run(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        DB::table('offices')->insertOrIgnore([
        [
            'id' => 1,
            'name' => 'Schools Division Superintendent',
            'main' => '1',
            'group' => null,
            'district' => null,
            'icon' => 'bi-building-fill',
            'show_order' => 1
        ],
        [
            'id' => 2,
            'name' => 'Assistant Schools Division Superintendent',
            'main' => '1',
            'group' => null,
            'district' => null,
            'icon' => 'bi-building',
            'show_order' => 2
        ],
        [
            'id' => 3,
            'name' => 'Cash',
            'main' => 'Admin',
            'group' => 'Admin',
            'district' => null,
            'icon' => 'bi-cash-coin',
            'show_order' => 8
        ],
        [
            'id' => 4,
            'name' => 'Personnel',
            'main' => 'Admin',
            'group' => 'Admin',
            'district' => null,
            'icon' => 'bi-file-person-fill',
            'show_order' => 9
        ],
        [
            'id' => 5,
            'name' => 'Property and Supply',
            'main' => 'Admin',
            'group' => 'Admin',
            'district' => null,
            'icon' => 'bi-backpack-fill',
            'show_order' => 11
        ],
        [
            'id' => 6,
            'name' => 'General Services',
            'main' => 'Admin',
            'group' => 'Admin',
            'district' => null,
            'icon' => 'bi-tools',
            'show_order' => 12
        ],
        [
            'id' => 7,
            'name' => 'Procurement',
            'main' => 'Admin',
            'group' => 'Admin',
            'district' => null,
            'icon' => 'bi-cart4',
            'show_order' => 13
        ],
        [
            'id' => 8,
            'name' => 'LRMS',
            'main' => 'CID',
            'group' => 'CID',
            'district' => null,
            'icon' => 'bi-book-fill',
            'show_order' => 14
        ],
        [
            'id' => 9,
            'name' => 'Instructional Management',
            'main' => 'CID',
            'group' => 'CID',
            'district' => null,
            'icon' => 'bi-bookmark-check-fill',
            'show_order' => 15
        ],
        [
            'id' => 10,
            'name' => 'PSDS',
            'main' => 'CID',
            'group' => 'CID',
            'district' => null,
            'icon' => 'bi-clipboard',
            'show_order' => 7
        ],
        [
            'id' => 11,
            'name' => 'SMME',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-buildings-fill',
            'show_order' => 16
        ],
        [
            'id' => 12,
            'name' => 'Social Mobilization',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-bus-front-fill',
            'show_order' => 17
        ],
        [
            'id' => 13,
            'name' => 'Planning and Research',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-collection-fill',
            'show_order' => 18
        ],
        [
            'id' => 14,
            'name' => 'HRD',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-person-workspace',
            'show_order' => 19
        ],
        [
            'id' => 15,
            'name' => 'Facilities',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-luggage-fill',
            'show_order' => 20
        ],
        [
            'id' => 16,
            'name' => 'School Health',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-clipboard-pulse',
            'show_order' => 21
        ],
        [
            'id' => 17,
            'name' => 'ICT Unit',
            'main' => '1',
            'group' => null,
            'district' => null,
            'icon' => 'bi-router-fill',
            'show_order' => 3
        ],
        [
            'id' => 18,
            'name' => 'Legal Unit',
            'main' => '1',
            'group' => null,
            'district' => null,
            'icon' => 'bi-briefcase-fill',
            'show_order' => 4
        ],
        [
            'id' => 19,
            'name' => 'Records',
            'main' => 'Admin',
            'group' => 'Admin',
            'district' => null,
            'icon' => 'bi-file-post',
            'show_order' => 10
        ],
        [
            'id' => 20,
            'name' => 'Accounting',
            'main' => 'Finance',
            'group' => 'Finance',
            'district' => null,
            'icon' => 'bi-calculator',
            'show_order' => 5
        ],
        [
            'id' => 21,
            'name' => 'Budget',
            'main' => 'Finance',
            'group' => 'Finance',
            'district' => null,
            'icon' => 'bi-file-spreadsheet',
            'show_order' => 6
        ],
        [
            'id' => 22,
            'name' => 'Engineering',
            'main' => 'SGOD',
            'group' => 'SGOD',
            'district' => null,
            'icon' => 'bi-rulers',
            'show_order' => 22
        ],
        [
            'id' => 25,
            'name' => 'ADMIN OFFICE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 26,
            'name' => 'ALIMADMAD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 27,
            'name' => 'ALIMADMAD IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 28,
            'name' => 'AMOGAD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 29,
            'name' => 'AMORCRUZ ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 30,
            'name' => 'AMPUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 31,
            'name' => 'ANAGASE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 32,
            'name' => 'ANAGASE IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 33,
            'name' => 'ANAGASE IS-CALINOGAN',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 34,
            'name' => 'ANDAP ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 35,
            'name' => 'ANDAP NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 36,
            'name' => 'ANDILI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 37,
            'name' => 'ANDILI ES-WILSON CONDES EXTENSION',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 38,
            'name' => 'ANDILI NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 39,
            'name' => 'ANIBONGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 40,
            'name' => 'ANIBONGAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 41,
            'name' => 'ANISLAGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 42,
            'name' => 'ANITAP ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 43,
            'name' => 'ANITAPAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 44,
            'name' => 'ANITAPAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 45,
            'name' => 'ANTEQUERA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 46,
            'name' => 'ANTEQUERA IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 47,
            'name' => 'ARAIBO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 48,
            'name' => 'ARAIBO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 49,
            'name' => 'ASDS OFFICE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 50,
            'name' => 'ATTY. ORLANDO S. RIMANDO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 51,
            'name' => 'AURORA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 52,
            'name' => 'AWAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 53,
            'name' => 'AWAO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 54,
            'name' => 'AWAO/CASOON/TUBO-TUBO/UNION-MT. DIWATA',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 55,
            'name' => 'AYAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 56,
            'name' => 'BABAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 57,
            'name' => 'BABAG NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 58,
            'name' => 'BAC UNIT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 59,
            'name' => 'BAGONG SILANG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 60,
            'name' => 'BAGONG SILANG NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 61,
            'name' => 'BAGONG TAAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 62,
            'name' => 'BAGONGON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 63,
            'name' => 'BAHI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 64,
            'name' => 'BAHI NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 65,
            'name' => 'BANAGBANAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 66,
            'name' => 'BANBANON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 67,
            'name' => 'BANGLASAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 68,
            'name' => 'BANGO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 69,
            'name' => 'BANGO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 70,
            'name' => 'BANGO NHS & CONSUELO M. VALDERRAMA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 71,
            'name' => 'BANGO/CM VALDERRAMA/MANGAYON/SAN MIGUEL/C AQUINO',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 72,
            'name' => 'BANKEROHAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 73,
            'name' => 'BANKEROHAN SUR ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 74,
            'name' => 'BANLAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 75,
            'name' => 'BANTACAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 76,
            'name' => 'BANTACAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 77,
            'name' => 'BARABAT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 78,
            'name' => 'BARUBO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 79,
            'name' => 'BASAK ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 80,
            'name' => 'BASAK IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 81,
            'name' => 'BATINAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 82,
            'name' => 'BAWANI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 83,
            'name' => 'BAYABAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 84,
            'name' => 'BAYABAS NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 85,
            'name' => 'BAYANIHAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 86,
            'name' => 'BAYLO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 87,
            'name' => 'BELMONTE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 88,
            'name' => 'BELMONTE INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 89,
            'name' => 'BELMONTE IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 90,
            'name' => 'BIASONG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 91,
            'name' => 'BINASBAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 92,
            'name' => 'BINOGSAYAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 93,
            'name' => 'BLISS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 94,
            'name' => 'BOAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 95,
            'name' => 'BOLLUKAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 96,
            'name' => 'BON TEMPLE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 97,
            'name' => 'BONGABONG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 98,
            'name' => 'BONGABONG NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 99,
            'name' => 'BONGBONG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 100,
            'name' => 'BONGKILATON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 101,
            'name' => 'BONGKILATON IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 102,
            'name' => 'BON-TEMPLE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ]
        ]);

        DB::table('offices')->insertOrIgnore([
        [
            'id' => 103,
            'name' => 'BORINGOT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 104,
            'name' => 'BORINGOT NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 105,
            'name' => 'BUCANA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 107,
            'name' => 'BUDGET AND FINANCE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 108,
            'name' => 'BUDGET UNIT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 109,
            'name' => 'BUHI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 110,
            'name' => 'BUKAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 111,
            'name' => 'CABACUNGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 112,
            'name' => 'CABANGGATAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 113,
            'name' => 'CABANGGATAN PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 114,
            'name' => 'CABANGKALAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 115,
            'name' => 'CABIDIANAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 116,
            'name' => 'CABIDIANAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 117,
            'name' => 'CABINUANGAN CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 118,
            'name' => 'CABINUANGAN CES/NEW BATAAN DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 119,
            'name' => 'CABUYAON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 120,
            'name' => 'CABUYOAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 121,
            'name' => 'CABUYUAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 122,
            'name' => 'CADUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 123,
            'name' => 'CAGAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 124,
            'name' => 'CALABCAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 125,
            'name' => 'CALABCAB PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 126,
            'name' => 'CALABCAB/PANGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 127,
            'name' => 'CALACAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 128,
            'name' => 'CALINOGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 129,
            'name' => 'CAMANLANGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 130,
            'name' => 'CAMANLANGAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 131,
            'name' => 'CAMANSI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 132,
            'name' => 'CAMANSI NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 133,
            'name' => 'CAMANTANGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 134,
            'name' => 'CAMANTANGAN ES/BANKEROHAN',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 135,
            'name' => 'CAMBAGANG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 136,
            'name' => 'CANDIIS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 137,
            'name' => 'CANDINUYAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 138,
            'name' => 'CANIDKID ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 139,
            'name' => 'CANIDKID IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 140,
            'name' => 'CARAGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 142,
            'name' => 'CASOON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 143,
            'name' => 'CASOON NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 144,
            'name' => 'CASOON NHS & NEW KAPATAGAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 145,
            'name' => 'CEBOLEDA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 146,
            'name' => 'CID',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 147,
            'name' => 'CLC-COMPOSTELA EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 148,
            'name' => 'CLC-COMPOSTELA WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 149,
            'name' => 'CLC-LAAK NORTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 150,
            'name' => 'CLC-LAAK SOUTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 151,
            'name' => 'CLC-MABINI DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 152,
            'name' => 'CLC-MACO NORTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 153,
            'name' => 'CLC-MACO SOUTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 154,
            'name' => 'CLC-MARAGUSAN EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 155,
            'name' => 'CLC-MARAGUSAN WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 156,
            'name' => 'CLC-MAWAB DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 157,
            'name' => 'CLC-MONKAYO EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 158,
            'name' => 'CLC-MONKAYO WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 159,
            'name' => 'CLC-MONTEVISTA DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 160,
            'name' => 'CLC-NABUNTURAN EAST DIST',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 161,
            'name' => 'CLC-NABUNTURAN EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 162,
            'name' => 'CLC-NABUNTURAN WEST DIST',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 163,
            'name' => 'CLC-NABUNTURAN WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 164,
            'name' => 'CLC-NEW BATAAN DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 165,
            'name' => 'CLC-PANTUKAN NORTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 166,
            'name' => 'CLC-PANTUKAN SOUTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 167,
            'name' => 'CM RECTO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 168,
            'name' => 'COA',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 169,
            'name' => 'COGONON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 170,
            'name' => 'COGONON IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 171,
            'name' => 'COMPOSTELA CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 172,
            'name' => 'COMPOSTELA CES SPED CENTER',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 173,
            'name' => 'COMPOSTELA CES-SC',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 174,
            'name' => 'COMPOSTELA DISTRICT/SECONDARY CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 175,
            'name' => 'COMPOSTELA EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 176,
            'name' => 'COMPOSTELA EAST DISTRICT CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 177,
            'name' => 'COMPOSTELA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 179,
            'name' => 'COMPOSTELA WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 180,
            'name' => 'COMPOSTELA WEST DISTRICT - SECONDARY CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 181,
            'name' => 'CONCEPCION ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 183,
            'name' => 'CONCEPCION IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 184,
            'name' => 'CONSUELO M. VALDERRAMA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 185,
            'name' => 'CORAZON C. AQUINO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 186,
            'name' => 'CORAZON C. AQUINO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 187,
            'name' => 'CORONOBE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 188,
            'name' => 'CORONOBE IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 189,
            'name' => 'DALAGUETE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 190,
            'name' => 'DALIMDIM ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 191,
            'name' => 'DANGGAYON INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 192,
            'name' => 'DANGGAYON IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 193,
            'name' => 'DATU AMPUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 194,
            'name' => 'DATU DAVAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 195,
            'name' => 'DATU DAVAO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 196,
            'name' => 'DAUMAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 197,
            'name' => 'DEL PILAR ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 198,
            'name' => 'DEPOT ANCESTRAL DOMAIN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 199,
            'name' => 'DEPOT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 200,
            'name' => 'DIAT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 201,
            'name' => 'DIOSDADO MACAPAGAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 202,
            'name' => 'DIOSDADO MACAPAGAL NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 203,
            'name' => 'DISTRICT OFFICE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 204,
            'name' => 'DIVISION OF DAVAO DE ORO',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 205,
            'name' => 'DIVISION OFFICE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 206,
            'name' => 'DON VICENTE ROMUALDEZ NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ]
        ]);

        DB::table('offices')->insertOrIgnore([
        [
            'id' => 207,
            'name' => 'DON WILLIAM GEMPERLE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 209,
            'name' => 'DO?A JOSEFA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 210,
            'name' => 'DOROTEO DE CASTRO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 211,
            'name' => 'DOROTEO DE CASTRO ES ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 212,
            'name' => 'DUMLAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 213,
            'name' => 'EDUARDO E. MAQUIDATO SR. ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 214,
            'name' => 'EDUARDO H. MAQUIDATO SR. ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 215,
            'name' => 'EL KATIPUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 216,
            'name' => 'ELIZALDE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 217,
            'name' => 'ELIZALDE NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 218,
            'name' => 'GABI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 219,
            'name' => 'GABI NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 220,
            'name' => 'GAYAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 221,
            'name' => 'GOLDEN VALLEY NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 222,
            'name' => 'GOV. VICENTE DUTERTE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 223,
            'name' => 'GUBATAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 224,
            'name' => 'GUBATAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 225,
            'name' => 'GUISOK ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 226,
            'name' => 'GUISOK PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 227,
            'name' => 'GUMAYAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 228,
            'name' => 'HAGUIMITAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 229,
            'name' => 'HIJO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 230,
            'name' => 'HINAGTUNGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 231,
            'name' => 'HR SECTION',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 232,
            'name' => 'HR UNIT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 233,
            'name' => 'ILPAPA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 234,
            'name' => 'IMELDA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 235,
            'name' => 'INAKAYAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 236,
            'name' => 'INAMBATAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 237,
            'name' => 'INOPAWAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 238,
            'name' => 'INUPUAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 239,
            'name' => 'KABURACANAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 240,
            'name' => 'KABURAKANAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 241,
            'name' => 'KALIGUTAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 242,
            'name' => 'KALIGUTAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 243,
            'name' => 'KALUYAPI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 244,
            'name' => 'KAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 245,
            'name' => 'KAO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 246,
            'name' => 'KAO NHS AND CABIDIANAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 247,
            'name' => 'KAPATAGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 248,
            'name' => 'KAPATAGAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 249,
            'name' => 'KAPOC ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 250,
            'name' => 'KATIPUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 251,
            'name' => 'KATIPUNAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 252,
            'name' => 'KIBAGUIO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 253,
            'name' => 'KIDAWA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 254,
            'name' => 'KIDAWA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 255,
            'name' => 'KILAGDENG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 256,
            'name' => 'KILAGDING NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 257,
            'name' => 'KINABUHI-AN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 258,
            'name' => 'KINGKING CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 259,
            'name' => 'KINGKING CESSC',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 260,
            'name' => 'KINUBAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 261,
            'name' => 'KIOKMAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 262,
            'name' => 'LA PURISIMA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 263,
            'name' => 'LAAK CENTRAL ES SPED CENTER',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 264,
            'name' => 'LAAK CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 265,
            'name' => 'LAAK DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 266,
            'name' => 'LAAK NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 267,
            'name' => 'LAAK NORTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 268,
            'name' => 'LAAK SOUTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 269,
            'name' => 'LAGAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 270,
            'name' => 'LAHI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 271,
            'name' => 'LANGGAM ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 272,
            'name' => 'LANGGAM ES-SAN JUAN',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 273,
            'name' => 'LANGGAM ES-SAN ROQUE EXT.',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 274,
            'name' => 'LANGGAM/SAN JUAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 275,
            'name' => 'LANGGAWISAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 276,
            'name' => 'LANGGAWISAN/NEW ALBAY/PALOC/TUPAZ NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 277,
            'name' => 'LANGTUD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 278,
            'name' => 'LAPU-LAPU ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 279,
            'name' => 'LAS ARENAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 280,
            'name' => 'LAWAAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 281,
            'name' => 'LIBASAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 282,
            'name' => 'LIBAYLIBAY NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 283,
            'name' => 'LIBOAC ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 284,
            'name' => 'LIBOAC PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 285,
            'name' => 'LIBUDON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 286,
            'name' => 'LIBUTON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 287,
            'name' => 'LIMBO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 288,
            'name' => 'LIMOT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 289,
            'name' => 'LINDA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 290,
            'name' => 'LINDA INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 291,
            'name' => 'LINIPUTAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 292,
            'name' => 'LINOAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 293,
            'name' => 'LIWANAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 294,
            'name' => 'LONGANAPAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 295,
            'name' => 'LONGANAPAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 296,
            'name' => 'LONOLONO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 297,
            'name' => 'LOWER AMPAWID ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 298,
            'name' => 'LOWER PANANSALAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 299,
            'name' => 'LOWER PANANSALAN ES-JACINTO EXT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 300,
            'name' => 'LOWER PANANSALAN PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 301,
            'name' => 'LRMDC',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 302,
            'name' => 'LS SARMIENTO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 303,
            'name' => 'LS SARMIENTO SR NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 304,
            'name' => 'LUMATAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 305,
            'name' => 'MABANDA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 306,
            'name' => 'MABINI CENTRAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 307,
            'name' => 'MABINI CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ]
        ]);

        DB::table('offices')->insertOrIgnore([
        [
            'id' => 308,
            'name' => 'MABINI DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 309,
            'name' => 'MABINI NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 310,
            'name' => 'MABUGNAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 311,
            'name' => 'MABUHAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 312,
            'name' => 'MABUHAY NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 313,
            'name' => 'MACO CENTRAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 314,
            'name' => 'MACO CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 315,
            'name' => 'MACO HEIGHTS CENTRAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 316,
            'name' => 'MACO HEIGHTS CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 317,
            'name' => 'MACO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 318,
            'name' => 'MACO NORTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 319,
            'name' => 'MACO NORTH DISTRICT OFFICE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 320,
            'name' => 'MACO SOUTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 321,
            'name' => 'MACOPA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 322,
            'name' => 'MAGADING ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 323,
            'name' => 'MAGANGIT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 324,
            'name' => 'MAGANGIT IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 325,
            'name' => 'MAGCAGONG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 326,
            'name' => 'MAGCAGONG NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 327,
            'name' => 'MAGNAGA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 328,
            'name' => 'MAGNAGA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 329,
            'name' => 'MAGSAYSAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 330,
            'name' => 'MAGSAYSAY NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 331,
            'name' => 'MAGTAYA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 332,
            'name' => 'MAHAYAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 333,
            'name' => 'MAHAYAHAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 334,
            'name' => 'MAINIT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 335,
            'name' => 'MAINIT NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 336,
            'name' => 'MAJOR ANGEL V. FAJARDO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 337,
            'name' => 'MAKOPA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 338,
            'name' => 'MALINAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 339,
            'name' => 'MALINAWON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 340,
            'name' => 'MAMBATANG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 342,
            'name' => 'MAMBUSAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 343,
            'name' => 'MAMONGA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 344,
            'name' => 'MANASA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 345,
            'name' => 'MANAT CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 346,
            'name' => 'MANAT NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 347,
            'name' => 'MANGAYON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 348,
            'name' => 'MANGAYON NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 349,
            'name' => 'MANGLOY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 350,
            'name' => 'MANGLOY NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 351,
            'name' => 'MANIPONGOL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 352,
            'name' => 'MANSINAO-AN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 353,
            'name' => 'MANURIGAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 354,
            'name' => 'MANURIGAO INTEGRATED SCHOOL- DIGAYNON EXT.',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 355,
            'name' => 'MANURIGAO IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 356,
            'name' => 'MAPAANG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 357,
            'name' => 'MAPACA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 358,
            'name' => 'MAPARAT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 359,
            'name' => 'MAPARAT NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 360,
            'name' => 'MAPASO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 361,
            'name' => 'MAPAWA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 362,
            'name' => 'MAPAWA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 363,
            'name' => 'MARAGUSAN  CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 364,
            'name' => 'MARAGUSAN CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 365,
            'name' => 'MARAGUSAN DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 366,
            'name' => 'MARAGUSAN EAST ',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 367,
            'name' => 'MARAGUSAN EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 368,
            'name' => 'MARAGUSAN EAST DISTRICT CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 369,
            'name' => 'MARAGUSAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 370,
            'name' => 'MARAGUSAN WEST DIST',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 371,
            'name' => 'MARAGUSAN WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 372,
            'name' => 'MARAGUSAN WEST DISTRICT CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 373,
            'name' => 'MASARA IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 374,
            'name' => 'MASICAREG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 375,
            'name' => 'MASINAO-AN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 376,
            'name' => 'MATAGDUNGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 377,
            'name' => 'MATANGAD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 378,
            'name' => 'MATIAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 379,
            'name' => 'MATILO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 380,
            'name' => 'MAUBOG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 381,
            'name' => 'MAUGAT ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 382,
            'name' => 'MAUGAT PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 383,
            'name' => 'MAUSWAGON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 384,
            'name' => 'MAWAB CENTRAL ES SC',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 385,
            'name' => 'MAWAB CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 386,
            'name' => 'MAWAB DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 387,
            'name' => 'MAYAON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 388,
            'name' => 'MAYAON NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 389,
            'name' => 'MAYAON/MONTEVISTA-DNAS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 390,
            'name' => 'MAYOBE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 391,
            'name' => 'MELALE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 392,
            'name' => 'MELALE NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 393,
            'name' => 'MIPANGI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 394,
            'name' => 'MONKAYO CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 395,
            'name' => 'MONKAYO EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 396,
            'name' => 'MONKAYO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 397,
            'name' => 'MONKAYO NHS - SHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 398,
            'name' => 'MONKAYO WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 399,
            'name' => 'MONKAYO WEST DISTRICT - SECONDARY CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 400,
            'name' => 'MONKAYO WEST DISTRICT (CLUSTER SCHOOLS)',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 401,
            'name' => 'MONTEVISTA CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 402,
            'name' => 'MONTEVISTA DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 403,
            'name' => 'MONTEVISTA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 404,
            'name' => 'MONTEVISTA NHS ANNEX',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 405,
            'name' => 'MONTEVISTA STAND ALONE SHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 406,
            'name' => 'MORIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 407,
            'name' => 'MT. DIWATA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 408,
            'name' => 'MUNOZ ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ]
        ]);

        DB::table('offices')->insertOrIgnore([
        [
            'id' => 409,
            'name' => 'MU?OZ ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 410,
            'name' => 'NABOC ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 411,
            'name' => 'NABUNTURAN CENTRAL ESSC',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 412,
            'name' => 'NABUNTURAN CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 413,
            'name' => 'NABUNTURAN CES-SPED CENTER',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 414,
            'name' => 'NABUNTURAN EAST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 415,
            'name' => 'NABUNTURAN EAST DISTRICT CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 416,
            'name' => 'NABUNTURAN NCHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 417,
            'name' => 'NABUNTURAN WEST DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 418,
            'name' => 'NAGA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 419,
            'name' => 'NAGAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 420,
            'name' => 'NAPNAPAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 421,
            'name' => 'NAPNAPAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 422,
            'name' => 'NEW ALBAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 423,
            'name' => 'NEW ALBAY NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 424,
            'name' => 'NEW ALEGRIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 425,
            'name' => 'NEW ASTURIAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 426,
            'name' => 'NEW BARILI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 427,
            'name' => 'NEW BATAAN DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 428,
            'name' => 'NEW BATAAN DISTRICT CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 429,
            'name' => 'NEW BATAAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 430,
            'name' => 'NEW BETHLEHEM ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 431,
            'name' => 'NEW CALAPE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 432,
            'name' => 'NEW DALAGUETE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 433,
            'name' => 'NEW DAUIS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 434,
            'name' => 'NEW KAPATAGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 435,
            'name' => 'NEW KAPATAGAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 436,
            'name' => 'NEW KATIPUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 437,
            'name' => 'NEW LEYTE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 438,
            'name' => 'NEW LEYTE NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 439,
            'name' => 'NEW MANAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 440,
            'name' => 'NEW NEGROS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 441,
            'name' => 'NEW PANAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 442,
            'name' => 'NEW PANAY IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 443,
            'name' => 'NEW SIBONGA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 444,
            'name' => 'NEW SIBONGA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 445,
            'name' => 'NEW VISAYAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 446,
            'name' => 'NEW VISAYAS NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 447,
            'name' => 'NEW VISAYAS PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 448,
            'name' => 'NGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 449,
            'name' => 'NGAN ES-PUTTING BATO',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 450,
            'name' => 'NUEVA VISAYAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 451,
            'name' => 'NUEVO ILOCO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 452,
            'name' => 'NUEVO ILOCO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 453,
            'name' => 'OFFICE OF THE SDS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 454,
            'name' => 'OGAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 455,
            'name' => 'OLAYCON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 456,
            'name' => 'OLAYCON INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 457,
            'name' => 'OSDS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 458,
            'name' => 'OSMENA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 459,
            'name' => 'OSME?A ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 460,
            'name' => 'P. FUENTES ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 461,
            'name' => 'PACO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 462,
            'name' => 'PAGSABANGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 463,
            'name' => 'PAGSABANGAN ES- BAREZ EXTENSION',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 464,
            'name' => 'PAGSILAAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 465,
            'name' => 'PALOC CES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 466,
            'name' => 'PALOC ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 467,
            'name' => 'PALOC NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 468,
            'name' => 'PAMINTARAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 469,
            'name' => 'PAMINTARAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 470,
            'name' => 'PANAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 471,
            'name' => 'PANAG ES-INOPAWAN',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 472,
            'name' => 'PANAMEN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 473,
            'name' => 'PANAMIN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 474,
            'name' => 'PANAMOREN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 475,
            'name' => 'PANANGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 476,
            'name' => 'PANANSALAN INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 477,
            'name' => 'PANGANASON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 478,
            'name' => 'PANGI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 479,
            'name' => 'PANGI NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 480,
            'name' => 'PANGUTOSAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 481,
            'name' => 'PANIBASAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 482,
            'name' => 'PANIBASAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 484,
            'name' => 'PANORAON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 485,
            'name' => 'PANTUKAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 486,
            'name' => 'PANTUKAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 487,
            'name' => 'PANTUKAN NORTH DIST',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 488,
            'name' => 'PANTUKAN NORTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 489,
            'name' => 'PANTUKAN NORTH DISTRICT CLUSTER SCHOOLS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 490,
            'name' => 'PANTUKAN SOUTH DISTRICT',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 491,
            'name' => 'PARASAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 492,
            'name' => 'PARASANON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 493,
            'name' => 'PARASANON IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 494,
            'name' => 'PASIAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 495,
            'name' => 'PASIAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 497,
            'name' => 'PIASUSUAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 498,
            'name' => 'PILAR ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 499,
            'name' => 'PINDASAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 500,
            'name' => 'PINDASAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 501,
            'name' => 'PLANNING',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 502,
            'name' => 'PONGPONG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 503,
            'name' => 'PONGPONG INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 504,
            'name' => 'PROSPERIDAD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 505,
            'name' => 'PROSPERIDAD TRIBAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 506,
            'name' => 'PULANG LUPA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 507,
            'name' => 'PUTING BATO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 508,
            'name' => 'RECTO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 509,
            'name' => 'RIZAL MEMORIAL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 510,
            'name' => 'SABUD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ]
        ]);

        DB::table('offices')->insertOrIgnore([
        [
            'id' => 511,
            'name' => 'SALVACION ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 512,
            'name' => 'SALVACION IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 513,
            'name' => 'SAMBAYON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 514,
            'name' => 'SAMUAG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 515,
            'name' => 'SAN ANTONIO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 516,
            'name' => 'SAN ANTONIO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 517,
            'name' => 'SAN ISIDRO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 518,
            'name' => 'SAN ISIDRO INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 519,
            'name' => 'SAN ISIDRO IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 520,
            'name' => 'SAN JOSE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 521,
            'name' => 'SAN JOSE ES ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 522,
            'name' => 'SAN JUAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 523,
            'name' => 'SAN JUAN ES (BASAK ANNEX)',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 524,
            'name' => 'SAN MIGUEL ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 525,
            'name' => 'SAN MIGUEL NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 526,
            'name' => 'SAN ROQUE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 527,
            'name' => 'SAN ROQUE PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 528,
            'name' => 'SAN VICENTE ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 529,
            'name' => 'SAN VICENTE IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 530,
            'name' => 'SAN VICENTE PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 531,
            'name' => 'SANGAB ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 532,
            'name' => 'SAOSAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 533,
            'name' => 'SAOSAO IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 534,
            'name' => 'SAPAWAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 535,
            'name' => 'SARANGA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 536,
            'name' => 'SAROG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 537,
            'name' => 'SASA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 538,
            'name' => 'SAWANGAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 539,
            'name' => 'SDS OFFICE',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 540,
            'name' => 'SGOD',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 541,
            'name' => 'SGOD-LSP',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 542,
            'name' => 'SGOD-PRP',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 543,
            'name' => 'SHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 544,
            'name' => 'SIMSIMEN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 545,
            'name' => 'SINGANAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 546,
            'name' => 'SINGANAN PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 547,
            'name' => 'SIOCON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 548,
            'name' => 'SIOCON NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 549,
            'name' => 'SISIMON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 550,
            'name' => 'STA. EMELIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 551,
            'name' => 'STA. EMILIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 552,
            'name' => 'STA. MARIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 553,
            'name' => 'STA. TERESA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 554,
            'name' => 'SUGOD ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 555,
            'name' => 'SUPPLY SECTION',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 556,
            'name' => 'TABONTABON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 557,
            'name' => 'TADYA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 558,
            'name' => 'TADYA PS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 559,
            'name' => 'TAGAYTAY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 560,
            'name' => 'TAGBALABAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 561,
            'name' => 'TAGBAROS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 562,
            'name' => 'TAGDANGUA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 563,
            'name' => 'TAGLAWIG ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 564,
            'name' => 'TAGNOCON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 565,
            'name' => 'TAGUGPO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 566,
            'name' => 'TAGUGPO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 567,
            'name' => 'TALIAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 568,
            'name' => 'TAMBONGON NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 569,
            'name' => 'TAMIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 570,
            'name' => 'TAN-AWAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 571,
            'name' => 'TAN-AWAN IS
',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 572,
            'name' => 'TANDAWAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 573,
            'name' => 'TANDAWAN INTEGRATED SCHOOL',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 574,
            'name' => 'TANDAWAN IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 575,
            'name' => 'TANDIK ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 576,
            'name' => 'TAPIA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 577,
            'name' => 'TAPIS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 578,
            'name' => 'TAYTAYAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 579,
            'name' => 'TERESA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 580,
            'name' => 'TERESA NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 581,
            'name' => 'TH VALDERRAMA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 582,
            'name' => 'TIBAGON ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 583,
            'name' => 'TIGASA ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 584,
            'name' => 'TIGBAO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 585,
            'name' => 'TIGBAO IS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 586,
            'name' => 'TOTOY ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 587,
            'name' => 'TUBORAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 588,
            'name' => 'TUBORAN NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 589,
            'name' => 'TUBO-TUBO ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 590,
            'name' => 'TUBO-TUBO NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 591,
            'name' => 'TUBURAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 592,
            'name' => 'TUGAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 593,
            'name' => 'TUGOP ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 594,
            'name' => 'TUGUNAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 595,
            'name' => 'TUK-AN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 596,
            'name' => 'TUPAS ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 597,
            'name' => 'TUPAZ NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 598,
            'name' => 'UDUAN ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 599,
            'name' => 'ULIP ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 600,
            'name' => 'ULIP NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 601,
            'name' => 'UNION NHS',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 602,
            'name' => 'UNION NHS-MT. DIWATA ANNEX',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ],
        [
            'id' => 603,
            'name' => 'UPPER CAMILI ES',
            'main' => ' ',
            'group' => null,
            'district' => ' ',
            'icon' => '',
            'show_order' => null
        ]
        ]);


        DB::table('services')->insertOrIgnore([
        [
            'id' => 9,
            'office_id' => 1,
            'name' => 'Travel Authority'
        ],
        [
            'id' => 10,
            'office_id' => 1,
            'name' => 'Other request/inquiries'
        ],
        [
            'id' => 11,
            'office_id' => 1,
            'name' => 'Feedback/Complaint'
        ],
        [
            'id' => 12,
            'office_id' => 2,
            'name' => 'BAC concern'
        ],
        [
            'id' => 13,
            'office_id' => 2,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 14,
            'office_id' => 2,
            'name' => 'Feedback/Complaint'
        ],
        [
            'id' => 15,
            'office_id' => 3,
            'name' => 'Cash Advance'
        ],
        [
            'id' => 16,
            'office_id' => 3,
            'name' => 'General Services-related'
        ],
        [
            'id' => 17,
            'office_id' => 3,
            'name' => 'Procurement-related'
        ],
        [
            'id' => 18,
            'office_id' => 3,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 19,
            'office_id' => 4,
            'name' => 'Application - Teaching Position'
        ],
        [
            'id' => 20,
            'office_id' => 4,
            'name' => 'Application - Non-teaching/Teaching-related'
        ],
        [
            'id' => 21,
            'office_id' => 4,
            'name' => 'Appointment (new, promotion, transfer, etc.)'
        ],
        [
            'id' => 22,
            'office_id' => 4,
            'name' => 'COE-Certificate of Employment'
        ],
        [
            'id' => 23,
            'office_id' => 4,
            'name' => 'Correction of Name/Change of Status'
        ],
        [
            'id' => 24,
            'office_id' => 4,
            'name' => 'ERF-Equivalent Record Form'
        ],
        [
            'id' => 25,
            'office_id' => 4,
            'name' => 'Leave Application'
        ],
        [
            'id' => 26,
            'office_id' => 4,
            'name' => 'Loan Approval and Verification'
        ],
        [
            'id' => 27,
            'office_id' => 4,
            'name' => 'Retirement'
        ],
        [
            'id' => 28,
            'office_id' => 4,
            'name' => 'Service Record'
        ],
        [
            'id' => 29,
            'office_id' => 4,
            'name' => 'Terminal Leave'
        ],
        [
            'id' => 30,
            'office_id' => 4,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 31,
            'office_id' => 19,
            'name' => 'CAV - Certification, Authentication and Verification'
        ],
        [
            'id' => 32,
            'office_id' => 19,
            'name' => 'Certified True Copy (CTC)/Photocopy of Documents'
        ],
        [
            'id' => 33,
            'office_id' => 19,
            'name' => 'Non-Certified True Copy documents'
        ],
        [
            'id' => 34,
            'office_id' => 19,
            'name' => 'Receiving & releasing of documents'
        ],
        [
            'id' => 35,
            'office_id' => 19,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 36,
            'office_id' => 19,
            'name' => 'Feedback/Complaint'
        ],
        [
            'id' => 37,
            'office_id' => 5,
            'name' => 'Inspection/Acceptance/Distribution of LRs, Supplies, Equipment'
        ],
        [
            'id' => 38,
            'office_id' => 5,
            'name' => 'Property and Equipment Clearance'
        ],
        [
            'id' => 39,
            'office_id' => 5,
            'name' => 'Request/Issuance of Supplies'
        ],
        [
            'id' => 40,
            'office_id' => 5,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 51,
            'office_id' => 8,
            'name' => 'ALS Enrollment'
        ],
        [
            'id' => 52,
            'office_id' => 8,
            'name' => 'Access to LR Portal'
        ],
        [
            'id' => 53,
            'office_id' => 8,
            'name' => 'Borrowing of books/learning materials'
        ],
        [
            'id' => 54,
            'office_id' => 8,
            'name' => 'Contextualized Learning Resources'
        ],
        [
            'id' => 55,
            'office_id' => 8,
            'name' => 'Quality Assurance of Supplementary Learning Resources'
        ],
        [
            'id' => 56,
            'office_id' => 8,
            'name' => 'Instructional Supervision'
        ],
        [
            'id' => 57,
            'office_id' => 8,
            'name' => 'Technical Assistance'
        ],
        [
            'id' => 58,
            'office_id' => 8,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 59,
            'office_id' => 9,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 60,
            'office_id' => 10,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 61,
            'office_id' => 20,
            'name' => 'Accounting-related'
        ],
        [
            'id' => 62,
            'office_id' => 20,
            'name' => 'ORS-Obligation Request and Status'
        ],
        [
            'id' => 63,
            'office_id' => 20,
            'name' => 'Posting/Updating of Disbursement'
        ],
        [
            'id' => 64,
            'office_id' => 20,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 65,
            'office_id' => 21,
            'name' => 'Bidget-related'
        ],
        [
            'id' => 66,
            'office_id' => 21,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 67,
            'office_id' => 17,
            'name' => 'Create/delete/rename/reset user accounts'
        ],
        [
            'id' => 68,
            'office_id' => 17,
            'name' => 'Troubleshooting of ICT equipment'
        ],
        [
            'id' => 69,
            'office_id' => 17,
            'name' => 'Uploading of publications'
        ],
        [
            'id' => 70,
            'office_id' => 17,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 71,
            'office_id' => 18,
            'name' => 'Certificate of No Pending Case'
        ],
        [
            'id' => 72,
            'office_id' => 18,
            'name' => 'Correction of Entries in School Records'
        ],
        [
            'id' => 73,
            'office_id' => 18,
            'name' => 'Feedback/Complaints'
        ],
        [
            'id' => 74,
            'office_id' => 18,
            'name' => 'Legal advice/opinion'
        ],
        [
            'id' => 75,
            'office_id' => 18,
            'name' => 'Sites titling'
        ],
        [
            'id' => 76,
            'office_id' => 18,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 77,
            'office_id' => 11,
            'name' => 'Private School Related'
        ],
        [
            'id' => 78,
            'office_id' => 13,
            'name' => 'Basic Education Data'
        ],
        [
            'id' => 79,
            'office_id' => 13,
            'name' => 'EBEIS/LIS/NAT Data and Performance Indicators'
        ],
        [
            'id' => 80,
            'office_id' => 13,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 81,
            'office_id' => 22,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 82,
            'office_id' => 16,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 83,
            'office_id' => 12,
            'name' => 'Other requests/inquiries'
        ],
        [
            'id' => 84,
            'office_id' => 11,
            'name' => 'Additional SHS Track for Private Schools'
        ],
        [
            'id' => 85,
            'office_id' => 11,
            'name' => 'Increase in tuition/other school fees (TOSF)'
        ],
        [
            'id' => 86,
            'office_id' => 11,
            'name' => 'No Increase in tuition/other school fees'
        ],
        [
            'id' => 87,
            'office_id' => 11,
            'name' => 'Private Schools Permit/Recognition/Renewal'
        ],
        [
            'id' => 88,
            'office_id' => 11,
            'name' => 'Special Orders-Graduatioin of Private School Learners'
        ],
        [
            'id' => 89,
            'office_id' => 11,
            'name' => 'Summer Permit for private schools'
        ],
        [
            'id' => 90,
            'office_id' => 11,
            'name' => 'Other privates school concern'
        ]
        ]);

        DB::table('sub_services')->insertOrIgnore([
        [
            'id' => 1,
            'service_id' => 10,
            'name' => 'General inquiry'
        ],
        [
            'id' => 2,
            'service_id' => 10,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 3,
            'service_id' => 10,
            'name' => 'Request for information'
        ],
        [
            'id' => 4,
            'service_id' => 10,
            'name' => 'Other concern'
        ],
        [
            'id' => 5,
            'service_id' => 13,
            'name' => 'General inquiry'
        ],
        [
            'id' => 6,
            'service_id' => 13,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 7,
            'service_id' => 13,
            'name' => 'Request for information'
        ],
        [
            'id' => 8,
            'service_id' => 13,
            'name' => 'Other concern'
        ],
        [
            'id' => 9,
            'service_id' => 18,
            'name' => 'General inquiry'
        ],
        [
            'id' => 10,
            'service_id' => 18,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 11,
            'service_id' => 18,
            'name' => 'Request for information'
        ],
        [
            'id' => 12,
            'service_id' => 18,
            'name' => 'Other concern'
        ],
        [
            'id' => 13,
            'service_id' => 30,
            'name' => 'General inquiry'
        ],
        [
            'id' => 14,
            'service_id' => 30,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 15,
            'service_id' => 30,
            'name' => 'Request for information'
        ],
        [
            'id' => 16,
            'service_id' => 30,
            'name' => 'Other concern'
        ],
        [
            'id' => 17,
            'service_id' => 40,
            'name' => 'General inquiry'
        ],
        [
            'id' => 18,
            'service_id' => 40,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 19,
            'service_id' => 40,
            'name' => 'Request for information'
        ],
        [
            'id' => 20,
            'service_id' => 40,
            'name' => 'Other concern'
        ],
        [
            'id' => 21,
            'service_id' => 58,
            'name' => 'General inquiry'
        ],
        [
            'id' => 22,
            'service_id' => 58,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 23,
            'service_id' => 58,
            'name' => 'Request for information'
        ],
        [
            'id' => 24,
            'service_id' => 58,
            'name' => 'Other concern'
        ],
        [
            'id' => 25,
            'service_id' => 59,
            'name' => 'General inquiry'
        ],
        [
            'id' => 26,
            'service_id' => 59,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 27,
            'service_id' => 59,
            'name' => 'Request for information'
        ],
        [
            'id' => 28,
            'service_id' => 59,
            'name' => 'Other concern'
        ],
        [
            'id' => 29,
            'service_id' => 60,
            'name' => 'General inquiry'
        ],
        [
            'id' => 30,
            'service_id' => 60,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 31,
            'service_id' => 60,
            'name' => 'Request for information'
        ],
        [
            'id' => 32,
            'service_id' => 60,
            'name' => 'Other concern'
        ],
        [
            'id' => 33,
            'service_id' => 83,
            'name' => 'General inquiry'
        ],
        [
            'id' => 34,
            'service_id' => 83,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 35,
            'service_id' => 83,
            'name' => 'Request for information'
        ],
        [
            'id' => 36,
            'service_id' => 83,
            'name' => 'Other concern'
        ],
        [
            'id' => 37,
            'service_id' => 80,
            'name' => 'General inquiry'
        ],
        [
            'id' => 38,
            'service_id' => 80,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 39,
            'service_id' => 80,
            'name' => 'Request for information'
        ],
        [
            'id' => 40,
            'service_id' => 80,
            'name' => 'Other concern'
        ],
        [
            'id' => 41,
            'service_id' => 82,
            'name' => 'General inquiry'
        ],
        [
            'id' => 42,
            'service_id' => 82,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 43,
            'service_id' => 82,
            'name' => 'Request for information'
        ],
        [
            'id' => 44,
            'service_id' => 82,
            'name' => 'Other concern'
        ],
        [
            'id' => 45,
            'service_id' => 70,
            'name' => 'General inquiry'
        ],
        [
            'id' => 46,
            'service_id' => 70,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 47,
            'service_id' => 70,
            'name' => 'Request for information'
        ],
        [
            'id' => 48,
            'service_id' => 70,
            'name' => 'Other concern'
        ],
        [
            'id' => 49,
            'service_id' => 76,
            'name' => 'General inquiry'
        ],
        [
            'id' => 50,
            'service_id' => 76,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 51,
            'service_id' => 76,
            'name' => 'Request for information'
        ],
        [
            'id' => 52,
            'service_id' => 76,
            'name' => 'Other concern'
        ],
        [
            'id' => 53,
            'service_id' => 35,
            'name' => 'General inquiry'
        ],
        [
            'id' => 54,
            'service_id' => 35,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 55,
            'service_id' => 35,
            'name' => 'Request for information'
        ],
        [
            'id' => 56,
            'service_id' => 35,
            'name' => 'Other concern'
        ],
        [
            'id' => 57,
            'service_id' => 64,
            'name' => 'General inquiry'
        ],
        [
            'id' => 58,
            'service_id' => 64,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 59,
            'service_id' => 64,
            'name' => 'Request for information'
        ],
        [
            'id' => 60,
            'service_id' => 64,
            'name' => 'Other concern'
        ],
        [
            'id' => 61,
            'service_id' => 66,
            'name' => 'General inquiry'
        ],
        [
            'id' => 62,
            'service_id' => 66,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 63,
            'service_id' => 66,
            'name' => 'Request for information'
        ],
        [
            'id' => 64,
            'service_id' => 66,
            'name' => 'Other concern'
        ],
        [
            'id' => 65,
            'service_id' => 81,
            'name' => 'General inquiry'
        ],
        [
            'id' => 66,
            'service_id' => 81,
            'name' => 'Document follow-up'
        ],
        [
            'id' => 67,
            'service_id' => 81,
            'name' => 'Request for information'
        ],
        [
            'id' => 68,
            'service_id' => 81,
            'name' => 'Other concern'
        ]
        ]);

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}