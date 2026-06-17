<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('booking_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('validated_by')->constrained('users')->cascadeOnDelete();
            $table->timestamp('validated_at');
            $table->timestamps();

            $table->unique('booking_id'); // one validation per booking
        });
    }
    public function down(): void {
        Schema::dropIfExists('booking_validations');
    }
};
