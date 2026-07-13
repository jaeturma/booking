<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('offices')->where('name', 'Admin')->where('main', 'CID')->update(['name' => 'PSDS']);
        DB::table('offices')->where('name', 'LRMDS')->where('main', 'CID')->update(['name' => 'LRMS']);
    }

    public function down(): void
    {
        DB::table('offices')->where('name', 'PSDS')->where('main', 'CID')->update(['name' => 'Admin']);
        DB::table('offices')->where('name', 'LRMS')->where('main', 'CID')->update(['name' => 'LRMDS']);
    }
};
