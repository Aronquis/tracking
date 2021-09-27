<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descripcion')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
        });
        Schema::create('slider', function (Blueprint $table) {
            $table->bigIncrements('sliderId');
            $table->text('titulo')->nullable();
            $table->integer('imagenPrincipal')->nullable();
            $table->timestamps();
        });
        Schema::create('tienda', function (Blueprint $table) {
            $table->bigIncrements('tiendaId');
            $table->text('nombre')->nullable();
            $table->text('slug')->nullable();
            $table->integer('imagenPrincipal')->nullable();
            $table->text('banco')->nullable();
            $table->text('correo')->nullable();
            $table->text('ruc')->nullable();
            $table->text('razonSocial')->nullable();
            $table->boolean('volkswagen')->nullable();
            $table->boolean('mercedes')->nullable();
            $table->boolean('c17210od')->nullable();
            $table->boolean('of1722')->nullable();
            $table->boolean('cummins')->nullable();
            $table->boolean('om366')->nullable();
            $table->boolean('om906')->nullable();
            $table->boolean('om924')->nullable();
            $table->timestamps();
        });
        Schema::create('sede', function (Blueprint $table) {
            $table->bigIncrements('sedeId');
            $table->text('direccion')->nullable();
            $table->text('lugar')->nullable();
            $table->bigInteger('tiendaId')->unsigned();
            $table->foreign('tiendaId')->references('tiendaId')->on('tienda')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('asesor', function (Blueprint $table) {
            $table->bigIncrements('asesorId');
            $table->text('nombre')->nullable();
            $table->text('url')->nullable();
            $table->bigInteger('tiendaId')->unsigned();
            $table->foreign('tiendaId')->references('tiendaId')->on('tienda')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('categoria', function (Blueprint $table) {
            $table->bigIncrements('categoriaId');
            $table->text('titulo')->nullable();
            $table->text('slug')->nullable();
            $table->integer('imagenPrincipal')->nullable();
            $table->timestamps();
        });
        Schema::create('categoria_tienda', function (Blueprint $table) {
            $table->bigIncrements('categoriaTiendaId');
            $table->bigInteger('tiendaId')->unsigned();
            $table->foreign('tiendaId')->references('tiendaId')->on('tienda')->onDelete('cascade');
            $table->bigInteger('categoriaId')->unsigned();
            $table->foreign('categoriaId')->references('categoriaId')->on('categoria')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('userId');
            $table->text('nombre')->nullable();
            $table->text('correo')->nullable();
            $table->text('celular')->nullable();
            $table->text('password')->nullable();
            $table->text('apiToken')->nullable();
            $table->text('tipoUsuario')->nullable();
            $table->integer('imagenPrincipal')->nullable();
            $table->timestamps();
        });
        Schema::create('formulario_tienda', function (Blueprint $table) {
            $table->bigIncrements('formularioId');
            $table->text('nombre')->nullable();
            $table->text('ruc')->nullable();
            $table->text('email')->nullable();
            $table->text('celular')->nullable();
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
        Schema::dropIfExists('users');
    }
}
