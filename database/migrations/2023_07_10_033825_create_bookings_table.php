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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('username');
            $table->string('email');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('full_name');
            $table->text('address');
            $table->string('phone');
            $table->enum('gender', ['Male', 'Female']);
            $table->bigInteger('total_price');
            $table->enum('status', ['Unpaid', 'Paid']);
            $table->enum('status_entrance', ['-', 'Check In', 'Check Out', 'Blacklist']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
