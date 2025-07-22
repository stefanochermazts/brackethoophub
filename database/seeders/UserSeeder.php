<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Organizzatore
        $organizer = User::create([
            'name' => 'Mario Rossi',
            'email' => 'organizer@test.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
        ]);

        // Società
        User::create([
            'name' => 'ASD Basket Roma',
            'email' => 'roma@test.com',
            'password' => Hash::make('password'),
            'role' => 'company',
            'organizer_id' => $organizer->id,
        ]);

        User::create([
            'name' => 'Pallacanestro Milano',
            'email' => 'milano@test.com',
            'password' => Hash::make('password'),
            'role' => 'company',
            'organizer_id' => $organizer->id,
        ]);

        // Coach
        User::create([
            'name' => 'Coach Luigi Verdi',
            'email' => 'coach1@test.com',
            'password' => Hash::make('password'),
            'role' => 'coach',
            'organizer_id' => $organizer->id,
        ]);

        User::create([
            'name' => 'Coach Anna Bianchi',
            'email' => 'coach2@test.com',
            'password' => Hash::make('password'),
            'role' => 'coach',
            'organizer_id' => $organizer->id,
        ]);

        // Players
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Giocatore $i",
                'email' => "player$i@test.com",
                'password' => Hash::make('password'),
                'role' => 'player',
                'organizer_id' => $organizer->id,
            ]);
        }
    }
} 