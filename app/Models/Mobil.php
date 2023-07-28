<?php

namespace App\Models;

use App\Models\Kendaraan;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Mobil extends Model
{
    use HasFactory;
    protected $table = 'mobil';
    protected $connection = 'mongodb';
    protected $fillable = [
        'mesin',
        'kapasitas_penumpang',
        'tipe',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
