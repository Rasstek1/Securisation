<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Crayon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Crayon::create([
                'nom' => $faker->randomElement(['Crayon de couleur', 'Crayon à papier', 'Crayon de cire'])." ".$faker->word." ".$faker->colorName,
                'quantite' => $faker->numberBetween(1, 100)
            ]);
        }
        \App\Models\User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@email.com',
            'password' => '$2b$12$Z6Giv02LdYii4pybukXXK.VcEgjG.mUCiBYNOA9Su0eu8SNINgFIe
'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => '$2b$12$2pWt0LAr9OmidhY8DmU/beUwdsfUj72apuS8WBYSGB6iFSey49fZe
'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Gordon',
            'email' => 'gb@mail.com',
            'password' => '$2b$12$TPHl6k7jPQNCG8SEbKux6u4zlBDY2mvBoeeduFv5IzXDiD.L74bZi
'
        ]);
    }
}
