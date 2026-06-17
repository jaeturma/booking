<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->boolean('requested_coa')->default(false); // if they want a COA
            $table->timestamps();

            $table->unique('booking_id'); // one survey per booking
        });
    }
    public function down(): void {
        Schema::dropIfExists('surveys');
    }
};
