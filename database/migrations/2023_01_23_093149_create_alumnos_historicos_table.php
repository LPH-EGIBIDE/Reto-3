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
            $table->foreignId('alumno_id')->constrained('alumnos');
            $table->foreignId('curso_id')->constrained('cursos');
            $table->foreignId('grado_id')->constrained('grados');
            $table->foreignId('facilitador_id')->constrained('facilitadores_empresa');
            $table->foreignId('empresa_id')->constrained('empresas')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();
            $table->primary(['alumno_id', 'curso_id', 'grado_id']);
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
