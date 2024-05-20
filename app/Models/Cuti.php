<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Cuti extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'id_karyawan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_hari'
    ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Relasi dengan table karyawan / 1 karyawan memilki banyak lembur
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
