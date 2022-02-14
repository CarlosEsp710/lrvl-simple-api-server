<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Carlos Espejel',
            'email' => 'carlos.espejel@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        User::factory(99)->create();
    }
}
