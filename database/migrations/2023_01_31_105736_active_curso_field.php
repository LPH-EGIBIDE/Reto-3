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
        //Add a active field to the cursos table
        Schema::table('cursos', function (Blueprint $table) {
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Remove the active field from the cursos table
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
};
