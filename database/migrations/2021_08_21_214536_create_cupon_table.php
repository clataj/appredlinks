<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('texto', 100);
            $table->string('descripcion', 250);
            $table->integer('cant_x_usua');
            $table->string('codigo', 255);
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->integer('num_cupon');
            $table->integer('empresa_id');
            $table->integer('sucursal_id');
            $table->integer('estado');
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
        Schema::dropIfExists('cupon');
    }
}
