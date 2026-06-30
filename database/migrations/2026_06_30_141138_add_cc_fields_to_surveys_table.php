<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            if (!Schema::hasColumn('surveys', 'sub_service_id')) {
                $table->foreignId('sub_service_id')
                    ->nullable()
                    ->constrained('sub_services')
                    ->nullOnDelete()
                    ->after('service_id');
            }
            if (!Schema::hasColumn('surveys', 'cc_aware')) {
                $table->string('cc_aware', 20)->nullable()->after('contact');
            }
            if (!Schema::hasColumn('surveys', 'cc_see')) {
                $table->string('cc_see', 20)->nullable()->after('cc_aware');
            }
            if (!Schema::hasColumn('surveys', 'cc_used')) {
                $table->string('cc_used', 20)->nullable()->after('cc_see');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            if (Schema::hasColumn('surveys', 'cc_used')) {
                $table->dropColumn('cc_used');
            }
            if (Schema::hasColumn('surveys', 'cc_see')) {
                $table->dropColumn('cc_see');
            }
            if (Schema::hasColumn('surveys', 'cc_aware')) {
                $table->dropColumn('cc_aware');
            }
            if (Schema::hasColumn('surveys', 'sub_service_id')) {
                $table->dropConstrainedForeignId('sub_service_id');
            }
        });
    }
};
