<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'judul_ta',
        'deskripsi',
        'bidang_minat',
        'status',
        'dosen_pembimbing1_id',
        'dosen_pembimbing2_id',
    ];

    /**
     * Relasi ke mahasiswa (tabel users)
     */
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    /**
     * Relasi ke dosen pembimbing 1
     */
    public function dosenPembimbing1()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing1_id');
    }

    /**
     * Relasi ke dosen pembimbing 2 (opsional)
     */
    public function dosenPembimbing2()
    {
        return $this->belongsTo(User::class, 'dosen_pembimbing2_id');
    }
}
