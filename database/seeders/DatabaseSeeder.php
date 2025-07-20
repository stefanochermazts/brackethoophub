<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@brackethoophub.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create some regular users
        User::factory(10)->create();

        // Seed settings
        $this->call(SettingsSeeder::class);
    }
}
