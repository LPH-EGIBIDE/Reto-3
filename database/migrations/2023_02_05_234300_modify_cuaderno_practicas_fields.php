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
        //Remove the old column called 'contenido' and add 3 new columns called 'contenido_actividades', 'contenido_reflexion' and 'contenido_problemas'
        Schema::table('cuaderno_practicas', function (Blueprint $table) {
            $table->dropColumn('contenido');
            $table->text('contenido_actividades')->nullable();
            $table->text('contenido_reflexion')->nullable();
            $table->text('contenido_problemas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Reverse the changes
        Schema::table('cuaderno_practicas', function (Blueprint $table) {
            $table->text('contenido')->nullable();
            $table->dropColumn('contenido_actividades');
            $table->dropColumn('contenido_reflexion');
            $table->dropColumn('contenido_problemas');
        });
    }
};
