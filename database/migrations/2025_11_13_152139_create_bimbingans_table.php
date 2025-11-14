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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();

            // Relasi ke Tugas Akhir yang dibimbing
            $table->foreignId('tugas_akhir_id')->constrained('tugas_akhirs')->onDelete('cascade');

            // Relasi ke Mahasiswa (User) yang mengajukan bimbingan
            $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');

            // Catatan yang diajukan oleh Mahasiswa (deskripsi kemajuan/permasalahan)
            $table->text('catatan_mahasiswa');

            // Respons atau feedback dari Dosen Pembimbing
            $table->text('catatan_dosen')->nullable();

            // Status: 'Menunggu', 'Disetujui', 'Ditolak'
            $table->string('status')->default('Menunggu');

            // Tanggal persetujuan/penolakan oleh dosen
            $table->timestamp('tanggal_respon')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
