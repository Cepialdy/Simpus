<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cek apakah kolom 'poli' sudah ada, jika belum tambahkan kolom dengan default value
        if (!Schema::hasColumn('patients', 'poli')) {
            Schema::table('patients', function (Blueprint $table) {
                // Menambahkan kolom 'poli' dengan default value 'General' dan bisa null
                $table->string('poli')->nullable()->default('General')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kolom 'poli' jika ada
        if (Schema::hasColumn('patients', 'poli')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn('poli');
            });
        }
    }
};
