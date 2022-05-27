<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory()->count(10)->create();
        User::create([
            'name' => 'Jose Araujo',
            'email' => 'jaraujome@gmail.com',
            'password' => bcrypt('JOSBET-03-10')

        ]); //->assignRole('Administrador');
         User::factory()->count(9)->create();

    }
}
