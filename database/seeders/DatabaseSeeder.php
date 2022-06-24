<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        \App\Models\User::create([
            'role' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Supervisor',
            'email' => 'elvis.poe96@yahoo.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        // Create Application
         \App\Models\Application::factory(50)->create();
    }
}
