<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_historicos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('alumno_id', false, true);
            $table->foreign('alumno_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('grado_id')->constrained('grados')->onDelete('cascade');
            $table->bigInteger('facilitador_centro', false, true)->nullable();
            $table->foreign('facilitador_centro')->references('id')->on('personas')->onDelete('set null');
            $table->bigInteger('facilitador_empresa', false, true)->nullable();
            $table->foreign('facilitador_empresa')->references('id')->on('personas')->onDelete('set null');
            $table->enum('estado', ['cursando', 'finalizado', 'repetido']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_historico');
    }
};
