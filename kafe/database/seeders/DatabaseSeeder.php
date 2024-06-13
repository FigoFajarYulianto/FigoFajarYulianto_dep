<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'erfandibagus532@gmail.com',
            'whatsapp' => '081331562302',
            'password' => Hash::make('admin'),
            'level_id' => 1,
            'status' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(60)
        ]);
    }
}