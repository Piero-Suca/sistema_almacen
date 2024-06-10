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
        Schema::create('programa', function (Blueprint $table) {
            $table->id(); // "id" UNSIGNED BIGINTEGER, PRIMARY KEY, AUTOINCREMENT
            $table->string('nombre', 150); // varchar(150)
            // 999999.99
            $table->decimal('igv', 8, 2)->default(18.00);
            $table->timestamps();
            // created_at -> timestamp -> guardar la fecha y hora de creacion del registro
            // updated_at -> timestamp -> guardar la fecha y hora de la ultima actualizacion
            // select * from tipo where eliminado = 0
            $table->softDeletes();
            // deleted_at -> timestamp -> mantenerse en null, pero guarda la fecha y hora de la eliminacion
            // select * from tipocusro where deleted_at IS NULL


            // $table->primary('codigo'); // INDICE

            // EVENTOS: antes de crear o despues de crear
            // antes de actualizar o despues de actualizar
            // antes de eliminar o despues de eliminar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa');
    }
};
