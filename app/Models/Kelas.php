<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $connection = 'mongodb';
    protected $fillable = [
        'class',
        'studyProgram'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
