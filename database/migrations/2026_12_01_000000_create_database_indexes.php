<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Roles table - add index on name if it doesn't exist
        if (!DB::getSchemaBuilder()->hasIndex('roles', 'roles_name_index')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->index('name', 'roles_name_index');
            });
        }

        // Santris table - add index on name if it doesn't exist
        if (!DB::getSchemaBuilder()->hasIndex('santris', 'santries_name_index')) {
            Schema::table('santris', function (Blueprint $table) {
                $table->index('name', 'santries_name_index');
            });
        }

        // Categories table - slug already has unique index from table creation
        // No need to add additional index

        // Posts table - slug already has unique index from table creation
        // No need to add additional index
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Roles table - remove index if it exists
        if (DB::getSchemaBuilder()->hasIndex('roles', 'roles_name_index')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropIndex(['name']);
            });
        }

        // Santris table - remove index if it exists
        if (DB::getSchemaBuilder()->hasIndex('santris', 'santries_name_index')) {
            Schema::table('santris', function (Blueprint $table) {
                $table->dropIndex(['name']);
            });
        }

        // Categories table - do not remove the existing unique index on slug
        // Posts table - do not remove the existing unique index on slug
    }
};