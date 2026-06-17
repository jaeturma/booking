<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // certificates: ob_ot and printed_at used in CertificateController and model casts
        Schema::table('certificates', function (Blueprint $table) {
            if (!Schema::hasColumn('certificates', 'ob_ot')) {
                $table->enum('ob_ot', ['OB', 'OT'])->default('OB')->after('purpose');
            }
            if (!Schema::hasColumn('certificates', 'printed_at')) {
                $table->timestamp('printed_at')->nullable()->after('issued_at');
            }
        });

        // bookings: is_survey is cast in Booking model but was never migrated
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'is_survey')) {
                $table->boolean('is_survey')->default(false)->after('is_hidden');
            }
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            if (Schema::hasColumn('certificates', 'printed_at')) {
                $table->dropColumn('printed_at');
            }
            if (Schema::hasColumn('certificates', 'ob_ot')) {
                $table->dropColumn('ob_ot');
            }
        });

        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'is_survey')) {
                $table->dropColumn('is_survey');
            }
        });
    }
};
