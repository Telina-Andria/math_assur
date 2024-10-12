<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'nom_utilisateur' => 'Admin',
        //     'mot_de_passe' => '12345',
        //     'role' => 0,
        // ]);

        // \App\Models\Client::factory(2)->create([
        //     "type_client" => "individuel",
        //     "by_utilisateur_id" => 1,
        // ]);

        \App\Models\Contrat::factory(3)->create([
            "by_client_id" => 2,
            "by_utilisateur_id" => 2,

        ]);
    }
}
