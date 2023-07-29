<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Mobil;
use App\Models\Motor;
use App\Models\Kendaraan;
use App\Services\MobilService;
use App\Services\MotorService;

class KendaraanRepository
{
    private Kendaraan $kendaraan;
    private Mobil $mobil;
    private Motor $motor;
    private MobilService $mobilService;
    private MotorService $motorService;
	public function __construct()
	{
		$this->kendaraan = new Kendaraan();
		$this->mobil = new Mobil();
        $this->motor = new Motor();
        $this->mobilService = new MobilService();
        $this->motorService = new MotorService();
	}
    public function getById($id)
    {
        $kendaraan = Kendaraan::with('mobil', 'motor')->find($id);
        if ($this->kendaraan->hasMobil($kendaraan) == true){
            $kendaraan = $this->kendaraan->removeMotor($kendaraan);
            return $kendaraan;
        } else if ($this->kendaraan->hasMotor($kendaraan) == true){
            $kendaraan = $this->kendaraan->removeMobil($kendaraan);
            return $kendaraan;
        }
    }
    public function getBy($jenis)
    {
        $kendaraan = Kendaraan::with('mobil', 'motor')->get();
        if ($this->kendaraan->hasMobil($kendaraan) == true){
            $kendaraan = $this->kendaraan->removeMotor($kendaraan);
            return $kendaraan;
        } else if ($this->kendaraan->hasMotor($kendaraan) == true){
            $kendaraan = $this->kendaraan->removeMobil($kendaraan);
            return $kendaraan;
        }
    }
    public function getAll()
    {
        $stokMobil = $this->mobilService->getAll();
        $stokMotor = $this->motorService->getAll();
        // $kendaraan = Kendaraan::get();
        $response = [
            'Mobil' => $stokMobil,
            'Motor' => $stokMotor,
        ];
        return $response;
    }
    public function store($data) : Object
    {
        $dataBaru = new $this->kendaraan;
        $dataBaru->tahun_keluaran = $data['tahun_keluaran'];
        $dataBaru->warna = $data['warna'];
        $dataBaru->harga = $data['harga'];
        $dataBaru->save();
        $mobil = new $this->mobil;
        $mobil->mesin = $data['mesin'];
        $mobil->kapasitas_penumpang = $data['kapasitas_penumpang'];
        $mobil->tipe = $data['tipe'];
        $mobil->kendaraan_id = $dataBaru->id;
        $mobil->save();
        return $mobil->fresh();
    }
    public function update($data, $id)
    {
        $kendaraan = Kendaraan::find($id);
        $kendaraan->update($data);
    }
    public function delete($id)
	{
        $user = User::find($id);
		$user->delete();
	}
    public function save(Kendaraan $kendaraan, array $data)
    {
        $kendaraan->update($data);
        return $kendaraan;
    }
}
