<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registration_costs', function (Blueprint $table) {
            // convert float to decimal
            $table->decimal('construction', 13, 2)->change();
            $table->decimal('facilities', 13, 2)->change();
            $table->decimal('wardrobe', 13, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration_costs', function (Blueprint $table) {
            $table->float('construction')->change();
            $table->float('facilities')->change();
            $table->float('wardrobe')->change();
        });
    }
};
