<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user (already exists in .env but seed for fresh DB)
        User::updateOrCreate(
            ['email' => 'admin@ponpes.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // change as needed
                'role_id' => '67f4067a-ce3d-4a4b-8718-79621bea56cd', // assuming role exists
                'remember_token' => Str::random(10),
            ]
        );
    }
}
?>