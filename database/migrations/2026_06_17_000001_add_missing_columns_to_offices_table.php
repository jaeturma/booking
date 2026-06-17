<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            if (!Schema::hasColumn('offices', 'show_order')) {
                $table->unsignedInteger('show_order')->nullable()->after('district');
            }
            if (!Schema::hasColumn('offices', 'main')) {
                $table->boolean('main')->default(false)->after('show_order');
            }
            if (!Schema::hasColumn('offices', 'icon')) {
                $table->string('icon')->nullable()->after('main');
            }
        });
    }

    public function down(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            if (Schema::hasColumn('offices', 'icon')) $table->dropColumn('icon');
            if (Schema::hasColumn('offices', 'main')) $table->dropColumn('main');
            if (Schema::hasColumn('offices', 'show_order')) $table->dropColumn('show_order');
        });
    }
};
