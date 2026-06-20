<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get Administrator role ID
        $adminRole = DB::table('roles')->where('name', 'Administrator')->first();
        $pengurusRole = DB::table('roles')->where('name', 'Pengurus')->first();
        $santriRole = DB::table('roles')->where('name', 'Santri')->first();

        if (!$adminRole || !$pengurusRole || !$santriRole) {
            $this->command->error('Roles not found. Please run RolesTableSeeder first.');
            return;
        }

        $users = [
            [
                'id' => Str::uuid(),
                'email' => 'admin@ponpes.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'  => $adminRole->id,
                'santri_id' => null // Admin doesn't have santri profile
            ],
            [
                'id' => Str::uuid(),
                'email' => 'pengurus@ponpes.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'  => $pengurusRole->id,
                'santri_id' => null
            ],
            [
                'id' => Str::uuid(),
                'email' => 'santri@ponpes.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id'  => $santriRole->id,
                'santri_id' => 'fa201ed9-6016-4d90-b3aa-f4858c5160d8'
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
