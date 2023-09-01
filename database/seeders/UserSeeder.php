<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "lastname" => "SUPER",
            "firstname" => "ADMIN",
            "email" => "adminecole229@gmail.com",
            "password" => Hash::make("admin229@"),
            "email_verified_at" => now(),
            "email_verified" => true
        ];

        User::create($data);
    }
}
