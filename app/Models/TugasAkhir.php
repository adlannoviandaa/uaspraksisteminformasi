<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        // ... (fillable lainnya)
        'status',
        'catatan_dosen',
    ];

    // ... (Relasi mahasiswa() dan dosenPembimbing1() sebelumnya)

    /**
     * Relasi: Tugas Akhir memiliki banyak log Bimbingan.
     */
    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class, 'tugas_akhir_id');
    }
}
