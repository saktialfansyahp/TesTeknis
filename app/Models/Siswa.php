<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $connection = 'mongodb';
    protected $fillable = [
        'name',
        'nim',
        'gender',
        'kelas_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function matapelajaran()
    {
        return $this->hasMany(MataPelajaran::class);
    }
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
