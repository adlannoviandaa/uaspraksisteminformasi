<?php

namespace App\Models;

// ... (use statements lainnya)

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

 protected $fillable = [
    'name',
    'password',
    'nim',
    'role',
];


    // ... (protected $hidden dan $casts lainnya)

    /**
     * Definisikan relasi: Mahasiswa memiliki satu Tugas Akhir.
     */
    public function tugasAkhirMahasiswa()
    {
        // User sebagai Mahasiswa, relasi ke kolom 'mahasiswa_id' di tabel tugas_akhir
        return $this->hasOne(TugasAkhir::class, 'mahasiswa_id');
    }

    /**
     * Definisikan relasi: Dosen dapat memiliki banyak Tugas Akhir (sebagai Pembimbing 1).
     */
    public function tugasAkhirPembimbing1()
    {
        // User sebagai Dosen Pembimbing, relasi ke kolom 'dosen_pembimbing1_id'
        return $this->hasMany(TugasAkhir::class, 'dosen_pembimbing1_id');
    }
}
