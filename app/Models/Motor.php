<?php

namespace App\Models;

use App\Models\Kendaraan;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Motor extends Model
{
    use HasFactory;
    protected $table = 'motor';
    protected $connection = 'mongodb';
    protected $fillable = [
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
        'kendaraan_id'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
