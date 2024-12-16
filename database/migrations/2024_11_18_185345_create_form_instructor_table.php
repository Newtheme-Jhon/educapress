<?php

use App\Enums\FormInstructorStatus;
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
        Schema::create('form_instructor', function (Blueprint $table) {
            $table->id();

            $table->string('tema');
            $table->string('categorias');
            $table->string('subcategorias');
            $table->string('user_id');
            $table->string('email');
            $table->string('user_name');
            $table->unsignedTinyInteger('status')->default(FormInstructorStatus::EN_PROCESO);
            $table->date('fecha');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_instructor');
    }
};
