<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'uraian_tugas',
        'mulai',
        'selesai',
        'ket'
    ];


    public function karyawan()
    {
        // Menghubungkan One to One ,satu lembur memiliki 1 karyawan
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
