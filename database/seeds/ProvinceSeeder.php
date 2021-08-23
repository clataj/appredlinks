<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('provincias')->insert([
            [
                'regId' => 0,
                'provDesc' => 'Guayas',
                'distritoId' => 0,
                'provEstado' => 'A'
            ],
            [
                'regId' => 0,
                'provDesc' => 'Pichincha',
                'distritoId' => 0,
                'provEstado' => 'A'
            ],
            [
                'regId' => 0,
                'provDesc' => 'Azogues',
                'distritoId' => 0,
                'provEstado' => 'A'
            ],
            [
                'regId' => 0,
                'provDesc' => 'Los Rios',
                'distritoId' => 0,
                'provEstado' => 'A'
            ],
            [
                'regId' => 0,
                'provDesc' => 'Manabí',
                'distritoId' => 0,
                'provEstado' => 'A'
            ],
        ]);
    }
}
