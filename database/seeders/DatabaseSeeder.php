<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Plataforma;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'Danny',
            'email' => 'danny_2003@ovi.com',
            'password' => \bcrypt('password'),
            'rol' => 'ADMIN',
        ]);

        $plataforma = Plataforma::create([
            'nombre' => 'Vimeo',
        ]);

        $plataforma = Plataforma::create([
            'nombre' => 'Youtube',
        ]);

    }
}
