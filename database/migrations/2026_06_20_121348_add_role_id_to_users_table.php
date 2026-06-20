<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add role_id column if it doesn't exist
        if (!Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->uuid('role_id')->nullable()->after('id');
                // Foreign key to roles.id (uuid)
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            });
        }

        // 2. Populate role_id based on existing role column (if role column exists)
        if (Schema::hasColumn('users', 'role')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $users = DB::table('users')->select('id', 'role')->get();
            foreach ($users as $user) {
                // Determine role name from existing role string; default to 'Pengurus' if empty
                $roleName = trim($user->role) ?: 'Pengurus';
                // Find or create role
                $role = Role::firstOrCreate(['name' => $roleName], [
                    'display_name' => ucfirst($roleName),
                    'description' => 'Role imported from legacy role column.',
                ]);
                // Update user with role_id
                DB::table('users')->where('id', $user->id)->update(['role_id' => $role->id]);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');


            // 4. Remove legacy role column
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: Dropping role_id and re-adding role column is destructive for new role assignments.
        // We'll attempt to restore role column from role_id if possible.

        // 1. Add role column back if role_id exists and role column doesn't exist
        if (Schema::hasColumn('users', 'role_id') && !Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->nullable()->after('password');
            });
        }

        // 2. Populate role column from role_id (if both exist)
        if (Schema::hasColumn('users', 'role_id') && Schema::hasColumn('users', 'role')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $users = DB::table('users')->select('id', 'role_id')->get();
            foreach ($users as $user) {
                if ($user->role_id) {
                    $role = Role::find($user->role_id);
                    $roleName = $role ? $role->name : '';
                    DB::table('users')->where('id', $user->id)->update(['role' => $roleName]);
                }
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // 3. Drop foreign key and column role_id if role_id exists
        if (Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            });
        }
    }
};
