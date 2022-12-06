<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Canal;
use App\Models\Plataforma;
use App\Models\User;
use App\Models\Video;
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

        Canal::create([
            'clave' => \uniqid(),
            'descripcion' => 'Hola este es mi canal',
            'user_id' => $user->id,
        ]);

        
        $plataforma = Plataforma::create([
            'nombre' => 'Vimeo',
        ]);
        
        $plataforma = Plataforma::create([
            'nombre' => 'Youtube',
        ]);
        
        Video::factory(30)->create();
    }
}
