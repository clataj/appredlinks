<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruc', 20);
            $table->string('razon_social', 100);
            $table->string('beneficio', 50);
            $table->string('nombre_comercial', 100);
            $table->integer('categoria_id');
            $table->integer('orden');
            $table->string('direccion', 150);
            $table->string('telefono', 50);
            $table->string('correo', 50);
            $table->string('twitter', 50);
            $table->string('facebook', 100);
            $table->string('instagram', 50);
            $table->string('website', 50);
            $table->string('ruta_img_small', 200);
            $table->string('ruta_img_large', 200);
            $table->string('tipo', 5);
            $table->date('inicio_carnet', 10);
            $table->date('fin_carnet', 10);
            $table->string('estado', 5);
            $table->string('ruta_img_small_2', 500);
            $table->string('ruta_img_large_2', 500);
            $table->string('ruta_fondo', 500);
            $table->integer('limite_cupon');
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
        Schema::dropIfExists('empresas');
    }
}
