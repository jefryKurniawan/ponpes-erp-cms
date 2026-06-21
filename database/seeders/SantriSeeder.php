<?php

use Illuminate\Database\Seeder;
use App\Models\Santri;

class SantriSeeder extends Seeder
{
    public function run()
    {
        // generate a few sample santri
        Santri::factory()->count(10)->create();
    }
}
?>