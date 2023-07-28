<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Penjualan;

class PenjualanRepository
{
    private Penjualan $penjualan;
	public function __construct()
	{
		$this->penjualan = new Penjualan();
	}
    public function getAll() : Object
    {
        $penjualan = Penjualan::with('kendaraan')->get();
        return $penjualan;
    }
    public function getById($id)
	{
		$task = User::with('penjualan')->find($id);
		return $task;
	}
    public function store($data) : Object
    {
        $penjualan = new $this->penjualan;
        $penjualan->kendaraan_id = $data['kendaraan_id'];
        $penjualan->harga = $data['harga'];
        $penjualan->jumlah_terjual = $data['jumlah_terjual'];
        $penjualan->total_harga = $data['total_harga'];
        $penjualan->save();
        return $penjualan->fresh();
    }
    public function update($data, $id)
    {
        $penjualan = Penjualan::find($id);
        $penjualan->update($data);
    }
    // public function delete($id)
	// {
    //     $kendaraan = Kendaraan::find($id);
    //     $penjualan = Penjualan::where('kendaraan_id', $kendaraan->_id)->first();
    //     if ($penjualan) {
    //         $penjualan->delete();
    //     }
	// 	$kendaraan->delete();
    //     return "Penjualan Deleted";
	// }
    public function save(Penjualan $penjualan, array $data)
    {
        $penjualan->update($data);
        return $penjualan;
    }
}
