<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    // Paksa Laravel menggunakan tabel yang benar
    protected $table = 'tugas_akhir';

    protected $fillable = [
        'mahasiswa_id',
        'judul_ta',
        'deskripsi',
        'bidang_minat',
        'status',
        'dosen_pembimbing1_id',
        'dosen_pembimbing2_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function dosenPembimbing1()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing1_id');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing2_id');
    }
}
