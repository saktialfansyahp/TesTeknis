<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'matapelajaran';
    protected $connection = 'mongodb';
    protected $fillable = [
        'name',
        'siswa_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
