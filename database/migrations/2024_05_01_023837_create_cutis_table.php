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
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_karyawan')->constrained('karyawans')->cascadeOnDelete();
            // $table->string('lamacuti');
            // $table->string('awalcuti');
            // $table->string('kategori_cuti');
            // $table->string('alasan_cuti');
            // $table->string('pengganti');
            // $table->string('status_cuti');
            $table->foreignId('karyawan_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('jumlah_hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
