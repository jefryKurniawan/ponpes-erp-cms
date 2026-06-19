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
        Schema::table('cash_books', function (Blueprint $table) {
            // Add category_id to link to keuangan_categories
            $table->uuid('category_id')->nullable()->after('syahriah_id');

            // Add tipe to explicitly store whether it's pemasukan or pengeluaran
            // This makes querying easier than inferring from debit/credit > 0
            $table->enum('tipe', ['pemasukan', 'pengeluaran'])->nullable()->after('category_id');

            // Add foreign key constraint
            $table->foreign('category_id')
                  ->references('id')
                  ->on('keuangan_categories')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });

        // Update existing records: set tipe based on whether debit or credit is greater
        // and set a default category (first one)
        DB::statement("
            UPDATE cash_books
            SET tipe = CASE
                WHEN debit > 0 THEN 'pemasukan'
                WHEN credit > 0 THEN 'pengeluaran'
                ELSE 'pemasukan'
            END,
            category_id = (SELECT id FROM keuangan_categories LIMIT 1)
            WHERE category_id IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cash_books', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'tipe']);
        });
    }
};