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
        Schema::create('moldes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escala_id');
            $table->string('nome')->unique();
            $table->text('distancia_base');
            $table->text('circunferencia_base');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moldes');
    }
};
