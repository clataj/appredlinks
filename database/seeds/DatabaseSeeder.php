<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class, StateSeeder::class, ProvinceSeeder::class, CitySeeder::class]);
        // User::create([
        //     'name' => 'cesar lata',
        //     'email' => 'clata@redlinks.com.ec',
        //     'password' => Hash::make('1234567890'),
        // ]);
        // $this->call(UserSeeder::class);
    }
}
