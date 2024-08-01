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
        Schema::create('pengajus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->string('nama_pengaju');
            $table->text('deskripsi');
            $table->integer('total');
            $table->foreignId('id_status')->constrained('statuses')->cascadeOnDelete();
            $table->foreignId('id_statusdana')->constrained('statusdanas')->cascadeOnDelete();
            $table->foreignId('id_keterangan')->constrained('keterangans')->cascadeOnDelete();
            $table->timestamp('forwarded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajus');
    }
};