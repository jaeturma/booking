<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->unique(['service_id', 'name']);
        });

        $otherServices = DB::table('services')
            ->where('name', 'like', '%Other%request%')
            ->orWhere('name', 'like', '%Other%inquir%')
            ->get(['id']);

        foreach ($otherServices as $service) {
            foreach (['General inquiry', 'Document follow-up', 'Request for information', 'Other concern'] as $name) {
                DB::table('sub_services')->insertOrIgnore([
                    'service_id' => $service->id,
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_services');
    }
};
