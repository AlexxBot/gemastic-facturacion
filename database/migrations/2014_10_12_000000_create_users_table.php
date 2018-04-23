<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedInteger('ID_Usuario')->required();
            $table->tinyInteger('Estado')->required();
            $table->unsignedInteger('Id_Perfil')->required();
            $table->unsignedInteger('Id_Negocio')->required();
            $table->string('UrlImagen',100)->nullable();


            $table->foreign('Id_Perfil')->references('ID')->on('perfiles');
            $table->foreign('Id_Negocio')->references('ID')->on('negocios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
