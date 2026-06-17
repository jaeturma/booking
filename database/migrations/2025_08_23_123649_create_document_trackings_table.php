<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('document_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->cascadeOnDelete();

            $table->string('status');              // "Received", "Processing", "For Approval", "Released", etc.
            $table->text('details')->nullable();

            $table->foreignId('office_id')->nullable()->constrained('offices')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('occurred_at')->useCurrent();

            $table->timestamps();

            $table->index(['document_id','occurred_at']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('document_trackings');
    }
};
