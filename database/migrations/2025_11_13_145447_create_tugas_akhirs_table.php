<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas_akhirs', function (Blueprint $table) {
            $table->id();
            // Kunci asing ke tabel users (mahasiswa yang mengajukan)
            $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
            $table->string('judul_ta');
            $table->text('deskripsi')->nullable();
            $table->string('bidang_minat')->nullable();
            $table->enum('status', ['Diajukan', 'Ditolak', 'Diterima']);
            $table->foreignId('dosen_pembimbing1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas_akhirs');
    }
};
