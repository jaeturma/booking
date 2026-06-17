<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no', 32)->unique();        // e.g., 8-digit "11223344"
            $table->string('title');
            $table->string('sender_name')->nullable();
            $table->timestamp('date_filed')->nullable();

            // optional context
            $table->foreignId('from_office_id')->nullable()->constrained('offices')->nullOnDelete();
            $table->foreignId('to_office_id')->nullable()->constrained('offices')->nullOnDelete();
            $table->foreignId('for_user_id')->nullable()->constrained('users')->nullOnDelete();

            // keep latest status at header for quick lookups (timeline is canonical)
            $table->string('latest_status')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('documents');
    }
};
