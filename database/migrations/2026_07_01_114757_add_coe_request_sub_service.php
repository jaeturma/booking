<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // "Other requests/inquiries" service under the Admin office (office_id 10)
        $service = DB::table('services')
            ->where('office_id', 10)
            ->where('name', 'Other requests/inquiries')
            ->first();

        if ($service && !DB::table('sub_services')->where('service_id', $service->id)->where('name', 'COE Request')->exists()) {
            DB::table('sub_services')->insert([
                'service_id' => $service->id,
                'name'       => 'COE Request',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $service = DB::table('services')
            ->where('office_id', 10)
            ->where('name', 'Other requests/inquiries')
            ->first();

        if ($service) {
            DB::table('sub_services')->where('service_id', $service->id)->where('name', 'COE Request')->delete();
        }
    }
};
