<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Penjualan;
use App\Services\KendaraanService;

class PenjualanRepository
{
    private Penjualan $penjualan;
    private KendaraanService $kendaraanService;
	public function __construct()
	{
		$this->penjualan = new Penjualan();
        $this->kendaraanService = new KendaraanService();
	}
    public function getAll()
    {
        $penjualan = Penjualan::with('kendaraan.motor', 'kendaraan.mobil')->get();
        $penjualanmotor = $penjualan->filter(function ($item) {
            return $this->penjualan->hasMotor($item);
        })->values();
        $penjualanmobil = $penjualan->filter(function ($item) {
            return $this->penjualan->hasMobil($item);
        })->values();
        $motor = $penjualanmotor->map(function ($item){
            if ($this->penjualan->hasMotor($item) == true){
                return $this->penjualan->removeMobil($item);
            }
        });
        $mobil = $penjualanmobil->map(function ($item){
            if ($this->penjualan->hasMobil($item) == true){
                return $this->penjualan->removeMotor($item);
            }
        });
        return [
            'Motor' => $motor,
            'Mobil' => $mobil
        ];
    }
    public function getBy($kendaraan)
	{
        $response = [];
        $response = $this->getAll();
        $kendaraan = strtolower($kendaraan);
        if ($kendaraan === 'motor') {
            $filteredData = [
                'Penjualan Motor' => $response['Motor']
            ];
        } elseif ($kendaraan === 'mobil') {
            $filteredData = [
                'Penjualan Mobil' => $response['Mobil']
            ];
        } else {
            $filteredData = [];
        }

        return $filteredData;
	}
    public function store($data) : Object
    {
        $kendaraan = $this->kendaraanService->getById($data['kendaraan_id']);
        $penjualan = new $this->penjualan;
        $penjualan->kendaraan_id = $data['kendaraan_id'];
        $penjualan->harga = $kendaraan->harga;
        $penjualan->jumlah_terjual = $data['jumlah_terjual'];
        $penjualan->total_harga = $kendaraan->harga * $data['jumlah_terjual'];
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
