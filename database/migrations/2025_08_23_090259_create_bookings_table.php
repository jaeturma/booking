<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // who created it (nullable for guest)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // guest info (optional, when user_id is null)
            $table->string('guest_name')->nullable();
            $table->string('guest_contact')->nullable();

            // office & service selected
            $table->foreignId('office_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();

            // booking code shown in QR / used by CSM
            $table->string('booking_code', 32)->unique();

            // business requirement
            $table->enum('customer_type', ['Citizen','Business','Government']);

            // workflow flags
            $table->boolean('is_validated')->default(false);

            // when the client intends to come (optional)
            $table->dateTime('scheduled_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
