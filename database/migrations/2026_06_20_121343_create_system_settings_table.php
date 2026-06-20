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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('pesantren_name');
            $table->string('tahun_berdiri')->nullable();
            $table->string('logo')->nullable(); // path to logo file
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->boolean('notif_email')->default(false);
            $table->boolean('notif_sms')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
