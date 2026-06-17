<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'office_id')) {
                $table->foreignId('office_id')
                    ->nullable()
                    ->constrained('offices')
                    ->nullOnDelete()
                    ->after('id');
            }
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'office_id')) {
                $table->dropConstrainedForeignId('office_id');
            }
        });
    }
};
