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
        Schema::create('teacher_payments', function (Blueprint $table) {
            $table->id();

            //campos nesesarios
            $table->string('payment_id');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('payment_amount'); //course price
            $table->string('payment_teacher'); //40% del payment_amount
            $table->string('payment_currency');
            $table->boolean('payment_return')->default(0);

            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_payments');
    }
};
