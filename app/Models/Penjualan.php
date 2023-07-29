<?php

namespace App\Models;

use App\Models\Kendaraan;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $connection = 'mongodb';
    protected $fillable = [
        'kendaraan_id',
        'harga',
        'jumlah_terjual',
        'total_harga'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
    public function removeMotor($penjualan)
    {
        if ($penjualan->kendaraan->relationLoaded('motor')) {
            unset($penjualan->kendaraan->motor);
        }
        return $penjualan;
    }
    public function removeMobil($penjualan)
    {
        if ($penjualan->kendaraan->relationLoaded('mobil')) {
            unset($penjualan->kendaraan->mobil);
        }
        return $penjualan;
    }
    public function hasMobil($penjualan){
        if($penjualan->kendaraan->mobil != null){
            return true;
        } else {
            return false;
        }

    }
    public function hasMotor($penjualan){
        if($penjualan->kendaraan->motor != null){
            return true;
        } else {
            return false;
        }
    }
    public function cek($penjualan){
        return $penjualan['kendaraan_id'];
    }
}
