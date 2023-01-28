<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $connection = 'mongodb';
    protected $fillable = [
        'latsol_1',
        'latsol_2',
        'latsol_3',
        'latsol_4',
        'uh_1',
        'uh_2',
        'uts',
        'us',
        'siswa_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function matapelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
