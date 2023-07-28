<?php

namespace App\Models;

use App\Models\Mobil;
// use Illuminate\Database\Eloquent\Model;
use App\Models\Motor;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $connection = 'mongodb';
    protected $fillable = [
        'tahun_keluaran',
        'warna',
        'harga'
    ];

    public function motor()
    {
        return $this->hasOne(Motor::class);
    }
    public function mobil()
    {
        return $this->hasOne(Mobil::class, 'kendaraan_id');
    }
}
