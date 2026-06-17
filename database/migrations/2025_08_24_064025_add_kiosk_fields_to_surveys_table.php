<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            // 7-digit employee number (nullable). Index for lookups.
            // If you want an FK to users.employee_no, see note below.
            $table->char('employee_no', 7)->nullable()->after('id')->index();

            // Office & Service (nullable FKs)
            $table->foreignId('office_id')
                ->nullable()
                ->constrained('offices')
                ->nullOnDelete()
                ->after('employee_no');

            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete()
                ->after('office_id');

            // Other metadata
            $table->string('customer_type', 20)->nullable()->after('service_id'); // e.g. employee|guest
            $table->unsignedTinyInteger('age')->nullable()->after('customer_type');
            $table->string('gender', 20)->nullable()->after('age');               // male|female|other|prefer_not_to_say
            $table->string('contact', 100)->nullable()->after('gender');          // phone/email
        });

        /**
         * OPTIONAL: add a real FK from surveys.employee_no -> users.employee_no
         * Only enable this if users.employee_no is a UNIQUE/INDEXED char(7).
         *
         * Schema::table('surveys', function (Blueprint $table) {
         *     $table->foreign('employee_no')
         *           ->references('employee_no')
         *           ->on('users')
         *           ->nullOnDelete();
         * });
         */
    }

    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            // Drop FKs in reverse order
            if (Schema::hasColumn('surveys', 'service_id')) {
                $table->dropConstrainedForeignId('service_id');
            }
            if (Schema::hasColumn('surveys', 'office_id')) {
                $table->dropConstrainedForeignId('office_id');
            }

            // If you added the optional FK on employee_no, drop it first:
            // try { $table->dropForeign(['employee_no']); } catch (\Throwable $e) {}

            if (Schema::hasColumn('surveys', 'employee_no')) $table->dropColumn('employee_no');
            if (Schema::hasColumn('surveys', 'customer_type')) $table->dropColumn('customer_type');
            if (Schema::hasColumn('surveys', 'age')) $table->dropColumn('age');
            if (Schema::hasColumn('surveys', 'gender')) $table->dropColumn('gender');
            if (Schema::hasColumn('surveys', 'contact')) $table->dropColumn('contact');
        });
    }
};
