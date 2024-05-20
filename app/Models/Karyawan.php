<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Karyawan extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'niy',
        'nama_karyawan',
        'jenis_kelamin',
        'alamat',
        'nohp',
        'email',
        'pendidikan',
        'jabatan'
    ];


    // Relasi ke table cuti / 1 karyawan memiliki beberapa cuti
    public function cutis()
    {
        return $this->hasMany(Cuti::class);
    }
    // Relasi ke table lembur / 1 karyawan memiliki beberapa lembur
    public function lemburs()
    {
        return $this->hasMany(Lembur::class);
    }

    public function liputans()
    {
        return $this->hasMany(Liputan::class);
    }
}
