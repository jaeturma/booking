<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('positions')->insertOrIgnore([
        [
            'id' => 1,
            'name' => 'ACCOUNTANT III',
            'sg' => 'SG'
        ],
        [
            'id' => 2,
            'name' => 'ADMINISTRATIVE AIDE I',
            'sg' => 'SG'
        ],
        [
            'id' => 3,
            'name' => 'ADMINISTRATIVE AIDE IV',
            'sg' => 'SG'
        ],
        [
            'id' => 4,
            'name' => 'ADMINISTRATIVE AIDE VI',
            'sg' => 'SG'
        ],
        [
            'id' => 5,
            'name' => 'ADMINISTRATIVE ASSISTANT I',
            'sg' => 'SG'
        ],
        [
            'id' => 6,
            'name' => 'ADMINISTRATIVE ASSISTANT II',
            'sg' => 'SG'
        ],
        [
            'id' => 7,
            'name' => 'ADMINISTRATIVE ASSISTANT III',
            'sg' => 'SG'
        ],
        [
            'id' => 8,
            'name' => 'ADMINISTRATIVE OFFICER II',
            'sg' => 'SG'
        ],
        [
            'id' => 9,
            'name' => 'ADMINISTRATIVE OFFICER IV',
            'sg' => 'SG'
        ],
        [
            'id' => 10,
            'name' => 'ADMINISTRATIVE OFFICER V',
            'sg' => 'SG'
        ],
        [
            'id' => 11,
            'name' => 'ASSISTANT SCHOOL PRINCIPAL II',
            'sg' => 'SG'
        ],
        [
            'id' => 12,
            'name' => 'CHIEF EDUCATION SUPERVISOR',
            'sg' => 'SG'
        ],
        [
            'id' => 13,
            'name' => 'DENTIST II',
            'sg' => 'SG'
        ],
        [
            'id' => 14,
            'name' => 'EDUCATION PROGRAM SPECIALIST II',
            'sg' => 'SG'
        ],
        [
            'id' => 15,
            'name' => 'EDUCATION PROGRAM SUPERVISOR',
            'sg' => 'SG'
        ],
        [
            'id' => 16,
            'name' => 'ENGINEER III',
            'sg' => 'SG'
        ],
        [
            'id' => 17,
            'name' => 'GUIDANCE COORDINATOR I',
            'sg' => 'SG'
        ],
        [
            'id' => 18,
            'name' => 'GUIDANCE COORDINATOR II',
            'sg' => 'SG'
        ],
        [
            'id' => 19,
            'name' => 'HEAD TEACHER I',
            'sg' => 'SG'
        ],
        [
            'id' => 20,
            'name' => 'HEAD TEACHER II',
            'sg' => 'SG'
        ],
        [
            'id' => 21,
            'name' => 'HEAD TEACHER III',
            'sg' => 'SG'
        ],
        [
            'id' => 22,
            'name' => 'INFORMATION TECHNOLOGY OFFICER I',
            'sg' => 'SG'
        ],
        [
            'id' => 23,
            'name' => 'LIBRARIAN II',
            'sg' => 'SG'
        ],
        [
            'id' => 24,
            'name' => 'MASTER TEACHER I',
            'sg' => 'SG'
        ],
        [
            'id' => 25,
            'name' => 'MASTER TEACHER II',
            'sg' => 'SG'
        ],
        [
            'id' => 26,
            'name' => 'MASTER TEACHER III',
            'sg' => 'SG'
        ],
        [
            'id' => 27,
            'name' => 'MEDICAL OFFICER III',
            'sg' => 'SG'
        ],
        [
            'id' => 28,
            'name' => 'NURSE II',
            'sg' => 'SG'
        ],
        [
            'id' => 29,
            'name' => 'PLANNING OFFICER III',
            'sg' => 'SG'
        ],
        [
            'id' => 30,
            'name' => 'PROJECT DEVELOPMENT OFFICER I',
            'sg' => 'SG'
        ],
        [
            'id' => 31,
            'name' => 'PROJECT DEVELOPMENT OFFICER II',
            'sg' => 'SG'
        ],
        [
            'id' => 32,
            'name' => 'PUBLIC SCHOOLS DISTRICT SUPERVISOR',
            'sg' => 'SG'
        ],
        [
            'id' => 33,
            'name' => 'REGISTRAR I',
            'sg' => 'SG'
        ],
        [
            'id' => 34,
            'name' => 'SCHOOL PRINCIPAL I',
            'sg' => 'SG'
        ],
        [
            'id' => 35,
            'name' => 'SCHOOL PRINCIPAL II',
            'sg' => 'SG'
        ],
        [
            'id' => 36,
            'name' => 'SCHOOL PRINCIPAL III',
            'sg' => 'SG'
        ],
        [
            'id' => 37,
            'name' => 'SCHOOL PRINCIPAL IV',
            'sg' => 'SG'
        ],
        [
            'id' => 38,
            'name' => 'SCHOOLS DIVISION SUPERINTENDENT',
            'sg' => 'SG'
        ],
        [
            'id' => 39,
            'name' => 'SENIOR EDUCATION PROGRAM SPECIALIST',
            'sg' => 'SG'
        ],
        [
            'id' => 40,
            'name' => 'SPECIAL EDUCATION TEACHER I',
            'sg' => 'SG'
        ],
        [
            'id' => 41,
            'name' => 'SPECIAL EDUCATION TEACHER II',
            'sg' => 'SG'
        ],
        [
            'id' => 42,
            'name' => 'SPECIAL EDUCATION TEACHER III',
            'sg' => 'SG'
        ],
        [
            'id' => 43,
            'name' => 'SPECIAL SCIENCE TEACHER I',
            'sg' => 'SG'
        ],
        [
            'id' => 44,
            'name' => 'TEACHER I',
            'sg' => 'SG'
        ],
        [
            'id' => 45,
            'name' => 'TEACHER II',
            'sg' => 'SG'
        ],
        [
            'id' => 46,
            'name' => 'TEACHER III',
            'sg' => 'SG'
        ]
        ]);
    }
}