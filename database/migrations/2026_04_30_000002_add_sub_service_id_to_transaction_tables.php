<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('sub_service_id')->nullable()->after('service_id')->constrained('sub_services')->nullOnDelete();
        });

        Schema::table('surveys', function (Blueprint $table) {
            if (!Schema::hasColumn('surveys', 'sub_service_id')) {
                $table->foreignId('sub_service_id')->nullable()->after('service_id')->constrained('sub_services')->nullOnDelete();
            }
        });

        Schema::table('certificates', function (Blueprint $table) {
            if (!Schema::hasColumn('certificates', 'sub_service_id')) {
                $table->foreignId('sub_service_id')->nullable()->after('service_id')->constrained('sub_services')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            if (Schema::hasColumn('certificates', 'sub_service_id')) {
                $table->dropConstrainedForeignId('sub_service_id');
            }
        });

        Schema::table('surveys', function (Blueprint $table) {
            if (Schema::hasColumn('surveys', 'sub_service_id')) {
                $table->dropConstrainedForeignId('sub_service_id');
            }
        });

        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'sub_service_id')) {
                $table->dropConstrainedForeignId('sub_service_id');
            }
        });
    }
};
