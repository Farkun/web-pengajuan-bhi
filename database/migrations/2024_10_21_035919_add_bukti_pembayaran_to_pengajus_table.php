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
        Schema::table('pengajus', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable();  // Menambahkan kolom bukti_pembayaran
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajus', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');  // Menghapus kolom bukti_pembayaran jika rollback
        });
    }
};