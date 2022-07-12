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
        $user = \App\Models\User::create([
            'role' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Supervisor',
            'email' => 'admin@supervisor.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        // Create User Days
        \App\Models\Days::create([
            'user_id' => $user->id,
            'days' => 21,
            'year' => date('Y')
        ]);
        \App\Models\Days::create([
            'user_id' => $user->id,
            'days' => 21,
            'year' => 2023
        ]);
        \App\Models\Days::create([
            'user_id' => $user->id,
            'days' => 21,
            'year' => 2024
        ]);

        // Create Application
        //\App\Models\Application::factory(5)->create();
    }
}
