<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\KeuanganCategorySeeder;
use Database\Seeders\CashBookSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Santri::factory()->create();
        // \App\Models\User::factory()->create();
        $this->call([
            // Core tables - Roles must come before Users
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            SantrisTableSeeder::class,
            CostsTableSeeder::class,

            // Keuangan tables
            KeuanganCategorySeeder::class,
            CashBookSeeder::class,

            // CMS tables
            CategoriesTableSeeder::class,
            PostsTableSeeder::class,
            GalleriesTableSeeder::class,
            SettingsTableSeeder::class,

            // Other tables
            // InMail::class,
            // OutMail::class,
            // PsbApplicationSeeder::class,
        ]);
    }
}