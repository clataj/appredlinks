<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id');
            $table->integer('orden');
            $table->string('qr', 50);
            $table->string('nombre', 100);
            $table->string('direccion', 150);
            $table->string('telefono', 30);
            $table->string('longitud_map', 20);
            $table->string('latitud_map', 20);
            $table->string('estado', 5);
            $table->string('dias_laborales');
            $table->string('dia_no_laboral_1');
            $table->string('dia_no_laboral_2');
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
        Schema::dropIfExists('sucursales');
    }
}
