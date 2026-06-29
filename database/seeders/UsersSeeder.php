<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Seeds only staff/admin users (those with assigned roles).
     * The full employee roster (7121 records) should be re-imported
     * via Admin > Users > Import CSV as it was originally.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
        [
            'id' => 1,
            'employee_no' => '8406069',
            'name' => 'John Arzaga',
            'email' => 'admin@admin.com',
            'email_verified_at' => '2025-09-01 00:16:02',
            'password' => '$2y$12$R5ryZCXqV41QN82VkXpBtu5eJCHKM400agjcTyLQa.ka9VZ6oFAbq',
            'remember_token' => null,
            'created_at' => '2025-08-23 09:00:36',
            'updated_at' => '2025-08-23 13:15:32',
            'position_id' => 1,
            'office_id' => 17,
            'bdate' => null
        ],
        [
            'id' => 2,
            'employee_no' => '8609090',
            'name' => 'John Eturma',
            'email' => 'eturma@mail.com',
            'email_verified_at' => null,
            'password' => '$2y$12$X/Vxl6DNqMOsmD4P11YL1ODjY7k0XdKnBjqKvBdFxwo99m4pE4vkG',
            'remember_token' => null,
            'created_at' => '2025-08-24 09:17:26',
            'updated_at' => '2025-08-24 15:47:55',
            'position_id' => 11,
            'office_id' => 17,
            'bdate' => null
        ],
        [
            'id' => 4,
            'employee_no' => '1000000',
            'name' => '-',
            'email' => 'guest@mail.com',
            'email_verified_at' => null,
            'password' => '$2y$12$vBMVawh/QY/sKvr8DzXFV.thndkpAQuBckLH13ZCqexje/7nUVsjq',
            'remember_token' => null,
            'created_at' => '2025-08-26 02:39:54',
            'updated_at' => '2025-08-26 02:39:54',
            'position_id' => 15,
            'office_id' => 17,
            'bdate' => null
        ],
        [
            'id' => 16324,
            'employee_no' => '100',
            'name' => 'SDS',
            'email' => 'sds@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$A3mx8gTL8cVvXc9RbQW17ujkbF9k.39vAi/UBo8h/3XfnApCPdF1S',
            'remember_token' => null,
            'created_at' => '2025-09-07 11:38:04',
            'updated_at' => '2025-09-07 11:38:04',
            'position_id' => 38,
            'office_id' => 1,
            'bdate' => null
        ],
        [
            'id' => 16325,
            'employee_no' => '101',
            'name' => 'ASDS',
            'email' => 'asds@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$y8YLeZyzQEB.u4VeCLSL3.6zUXUe6EXWhwtmER/cu3C/NoI3JkSYO',
            'remember_token' => null,
            'created_at' => '2025-09-07 13:44:52',
            'updated_at' => '2025-09-07 13:44:52',
            'position_id' => 38,
            'office_id' => 2,
            'bdate' => null
        ],
        [
            'id' => 16326,
            'employee_no' => '102',
            'name' => 'ICT',
            'email' => 'ict@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$ETXlyxaxva95iIDcZHpZlOaM6YlXUdJMkAYap2UyPNTBULlXLIRDe',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:22:02',
            'updated_at' => '2025-09-07 15:22:02',
            'position_id' => 22,
            'office_id' => 17,
            'bdate' => null
        ],
        [
            'id' => 16327,
            'employee_no' => '103',
            'name' => 'Legal',
            'email' => 'legal@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$Z67h.JgnFw.bT67h17Cro.gFcHSIX8SJ.KU5v91XSt/WILHDuHWki',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:23:21',
            'updated_at' => '2025-09-07 15:23:21',
            'position_id' => 10,
            'office_id' => 18,
            'bdate' => null
        ],
        [
            'id' => 16328,
            'employee_no' => '104',
            'name' => 'Accounting',
            'email' => 'accounting@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$L5hbHODn91TT35sfh8bobOc.uRuwCYDJWFdfMQUMxRgWWcp.fOuPW',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:24:59',
            'updated_at' => '2025-09-07 15:24:59',
            'position_id' => 1,
            'office_id' => 20,
            'bdate' => null
        ],
        [
            'id' => 16329,
            'employee_no' => '105',
            'name' => 'Budget',
            'email' => 'budget@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$oDEP8Hqtw6zxZYpSaSCIheXmdUc/WxvFvaKDFKjY/juZ0jA26nvp.',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:26:12',
            'updated_at' => '2025-09-07 15:26:12',
            'position_id' => 9,
            'office_id' => 21,
            'bdate' => null
        ],
        [
            'id' => 16330,
            'employee_no' => '106',
            'name' => 'Admin',
            'email' => 'admin@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$AKgpQb8Q0n4mw1ulN7TwAOFeb3eXSkIZ.v0WewsJybsAI/MtKRrqS',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:27:02',
            'updated_at' => '2026-04-30 14:28:12',
            'position_id' => 10,
            'office_id' => 10,
            'bdate' => null
        ],
        [
            'id' => 16331,
            'employee_no' => '107',
            'name' => 'Cash',
            'email' => 'cash@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$u/002acP1PL0kgbEEUF1uuGKGRNoVzMUS289QSN.iiWXVD73wbM9i',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:56:48',
            'updated_at' => '2025-09-07 15:56:48',
            'position_id' => 9,
            'office_id' => 3,
            'bdate' => null
        ],
        [
            'id' => 16332,
            'employee_no' => '108',
            'name' => 'Personnel',
            'email' => 'personnel@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$mbo/uoqGbLAdMkuLdJYwt.D4kEpJYRnSK8fwn3W4.EVp5XIWStCvq',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:57:43',
            'updated_at' => '2025-09-07 15:57:43',
            'position_id' => 9,
            'office_id' => 4,
            'bdate' => null
        ],
        [
            'id' => 16333,
            'employee_no' => '109',
            'name' => 'Records',
            'email' => 'records@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$5Cl4shzG.W0LraWcqZvcOe19qmkKbVwk1kBW9dAklUlNUdtJ0YX6K',
            'remember_token' => null,
            'created_at' => '2025-09-07 15:58:40',
            'updated_at' => '2025-09-07 15:58:40',
            'position_id' => 9,
            'office_id' => 19,
            'bdate' => null
        ],
        [
            'id' => 16334,
            'employee_no' => '110',
            'name' => 'Supply',
            'email' => 'supply@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$o2vZ.3EuTMjCE3s6HTONzO.FHsBRKGfQQKbm7T7L7MeAMmGiGskvG',
            'remember_token' => null,
            'created_at' => '2025-09-07 16:00:06',
            'updated_at' => '2025-09-07 16:00:06',
            'position_id' => 9,
            'office_id' => 5,
            'bdate' => null
        ],
        [
            'id' => 16335,
            'employee_no' => '111',
            'name' => 'BAC',
            'email' => 'bac@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$phCCcmj3mfsh.MRRxCKGS.Ahr7moXVHyFybZQl3WppyRQpj9jVsCu',
            'remember_token' => null,
            'created_at' => '2025-09-07 16:06:09',
            'updated_at' => '2025-09-07 16:06:09',
            'position_id' => 9,
            'office_id' => 7,
            'bdate' => null
        ],
        [
            'id' => 16336,
            'employee_no' => '112',
            'name' => 'LRMDS',
            'email' => 'lrmds@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$8MyGpBx8Di347I2DnEkO7eKk6wcdjPiPzPXaxihIyH7USBAz9vu0e',
            'remember_token' => null,
            'created_at' => '2025-09-07 16:07:00',
            'updated_at' => '2025-09-07 16:07:00',
            'position_id' => 8,
            'office_id' => 8,
            'bdate' => null
        ],
        [
            'id' => 16337,
            'employee_no' => '113',
            'name' => 'SGOD',
            'email' => 'sgod@sdo.com',
            'email_verified_at' => null,
            'password' => '$2y$12$wKOYccx5kYn5PlTyenthuOOsfq9hem1NuqGkvDURhuMz2/jDpnyeW',
            'remember_token' => null,
            'created_at' => '2025-09-07 16:20:48',
            'updated_at' => '2025-09-07 16:20:48',
            'position_id' => 9,
            'office_id' => 540,
            'bdate' => null
        ]
        ]);

        // Note: IDs [3, 8196] are in model_has_roles but no longer in users (deleted).

        DB::table('model_has_roles')->insertOrIgnore([
        [
            'role_id' => 1,
            'model_type' => 'App\\Models\\User',
            'model_id' => 1
        ],
        [
            'role_id' => 1,
            'model_type' => 'App\\Models\\User',
            'model_id' => 8196
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 2
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 3
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 8196
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16324
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16325
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16326
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16327
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16328
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16329
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16330
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16331
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16332
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16333
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16334
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16335
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16336
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16337
        ],
        [
            'role_id' => 3,
            'model_type' => 'App\\Models\\User',
            'model_id' => 3
        ],
        [
            'role_id' => 3,
            'model_type' => 'App\\Models\\User',
            'model_id' => 4
        ],
        [
            'role_id' => 3,
            'model_type' => 'App\\Models\\User',
            'model_id' => 8196
        ],
        [
            'role_id' => 4,
            'model_type' => 'App\\Models\\User',
            'model_id' => 16330
        ]
        ]);
    }
}