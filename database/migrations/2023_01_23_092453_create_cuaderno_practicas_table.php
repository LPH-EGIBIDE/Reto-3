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
        Schema::create('cuaderno_practicas', function (Blueprint $table) {
            $table->foreignId('historico_id')->constrained('alumnos_historicos')->onDelete('cascade');
            $table->integer('semana');
            $table->integer('estado')->default(1);
            $table->string('observaciones')->nullable();
            $table->string('contenido')->nullable();
            $table->primary(['historico_id', 'semana']);
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
        Schema::dropIfExists('cuaderno_practicas');
    }
};
