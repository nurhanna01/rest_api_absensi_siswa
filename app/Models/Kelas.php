<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable=[
        'kode_kelas',
        'nama_kelas'
    ];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class,'kelas_siswa');
    }
}
