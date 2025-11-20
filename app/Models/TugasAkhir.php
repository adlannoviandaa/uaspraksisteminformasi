<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'judul_ta',
        'status',
        'pembimbing1_id',
        'pembimbing2_id',
    ];

    public function dosenPembimbing1()
    {
        return $this->belongsTo(User::class, 'pembimbing1_id');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(User::class, 'pembimbing2_id');
    }
}
