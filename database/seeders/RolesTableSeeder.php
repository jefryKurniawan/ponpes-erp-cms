<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => Str::uuid(),
                'name' => 'Administrator',
                'display_name' => 'Administrator',
                'description' => 'Full access to all system features',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pengurus',
                'display_name' => 'Pengurus',
                'description' => 'Manage pesantren operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Bendahara',
                'display_name' => 'Bendahara',
                'description' => 'Manage financial transactions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Guru',
                'display_name' => 'Guru',
                'description' => 'Manage academic and santri data',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Santri',
                'display_name' => 'Santri',
                'description' => 'Limited access for santri portal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}