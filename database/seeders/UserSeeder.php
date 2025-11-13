<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "Admin",
            "username" => "admin",
            "email" => "harel.nugroho29@gmail.com",
            "password" => Hash::make("pass123"),
        ]);

        User::factory(9)->create();
    }
}
