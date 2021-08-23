<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('ciudad')->insert([
            [
                'paisId' => 1,
                'provId' => 1,
                'ciudDesc' => 'Guayaquil',
                'ciudEstado' => 'A'
            ],
            [
                'paisId' => 1,
                'provId' => 2,
                'ciudDesc' => 'Quito',
                'ciudEstado' => 'A'
            ],
            [
                'paisId' => 1,
                'provId' => 1,
                'ciudDesc' => 'Durán',
                'ciudEstado' => 'A'
            ],
            [
                'paisId' => 1,
                'provId' => 3,
                'ciudDesc' => 'Cuenca',
                'ciudEstado' => 'A'
            ],
            [
                'paisId' => 1,
                'provId' => 4,
                'ciudDesc' => 'Babahoyo',
                'ciudEstado' => 'A'
            ],
            [
                'paisId' => 1,
                'provId' => 1,
                'ciudDesc' => 'Samborondón',
                'ciudEstado' => 'A'
            ],
            [
                'paisId' => 1,
                'provId' => 5,
                'ciudDesc' => 'Bahía de Caráquez',
                'ciudEstado' => 'A'
            ],
        ]);
    }
}
