<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('estados')->insert([
            [
                'nombre' => 'PUNTOS ASIGNADOS',
                'descripcion' => 'ESTADO DE PUNTOS ASIGNADOS AL USUARIO',
                'tipo' => 1
            ],
            [
                'nombre' => 'CUPONES DISPONIBLES',
                'descripcion' => 'ESTADO DE CUPONES DISPONIBLES',
                'tipo' => 2
            ],
            [
                'nombre' => 'CUPON CANJEADO',
                'descripcion' => 'ESTADO DE CUPON CANJEADO',
                'tipo' => 2
            ],
            [
                'nombre' => 'CUPON POR CANJEAR',
                'descripcion' => 'ESTADO DE CUPON POR CANJEAR',
                'tipo' => 2
            ],
            [
                'nombre' => 'CUPONES ELIMINADOS',
                'descripcion' => 'ESTADO DE CUPON ELIMINADO',
                'tipo' => 2
            ],
        ]);
    }
}
