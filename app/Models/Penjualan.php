<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
