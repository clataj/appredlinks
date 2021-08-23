<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('roles')->insert([
            [
                'id' => 1,
                'descripcion' => 'administrador'
            ],
            [
                'id' => 2,
                'descripcion' => 'empresa'
            ]
        ]);
    }
}
