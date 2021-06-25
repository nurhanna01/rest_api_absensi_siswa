<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class Siswa extends Authenticatable
{
    use HasApiTokens,HasFactory;

    protected $fillable=[
        'nim',
        'nama',
        'password'
    ];

    protected $table='siswas';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class,'kelas_siswa');
    }
}
