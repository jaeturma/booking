<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('certificate_number', 32)->unique();
            $table->string('guest_name')->nullable();
            $table->string('purpose')->nullable();
            $table->timestamp('issued_at');
            $table->timestamps();

            $table->unique('booking_id'); // at most one COA per booking
        });
    }
    public function down(): void {
        Schema::dropIfExists('certificates');
    }
};
