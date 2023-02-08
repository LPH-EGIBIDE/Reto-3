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
        Schema::table('personas', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_pic_id')->nullable();
            $table->foreign('profile_pic_id')->references('id')->on('attachments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign(['profile_pic_id']);
            $table->dropColumn('profile_pic_id');
        });
    }
};



/*
 *                      @if($alumno->persona->profile_pic_id)
                        <img class="img-fluid" src="{{$alumno->persona->fotoPerfil->file_path}}" alt="Foto persona">
                    @else
                        <img class="img-fluid" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto persona">
                    @endif
                    <input type="file" name="profile_image" id="profpic" class="d-none">
                    @can('is_coordinador')
                        <input type="button" class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
                    @endcan
 */
