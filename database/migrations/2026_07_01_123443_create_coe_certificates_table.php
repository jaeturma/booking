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
        Schema::create('coe_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('certificate_number', 32)->unique();
            $table->string('employee_name')->nullable();
            $table->string('position')->nullable();
            $table->string('district')->nullable();
            $table->string('school_office')->nullable();
            $table->string('purpose')->nullable();
            $table->timestamp('issued_at');
            $table->timestamp('printed_at')->nullable();
            $table->timestamps();

            $table->unique('booking_id'); // at most one COE certificate per booking
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coe_certificates');
    }
};
