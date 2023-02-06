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
            $table->id();
            $table->foreignId('historico_id')->constrained('alumnos_historicos')->onDelete('cascade');
            $table->integer('semana');
            $table->integer('estado')->default(0);
            $table->string('observaciones')->nullable();
            $table->string('contenido')->nullable();
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
