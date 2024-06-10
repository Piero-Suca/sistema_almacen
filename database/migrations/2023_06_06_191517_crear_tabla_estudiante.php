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
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 120);
            $table->string("imagen", 200)->nullable();
            $table->unsignedBigInteger("programa_id");
            $table->timestamps();
            // crear la relacion entre curso - tipocurso
            $table->foreign("programa_id")->on("programa")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};
