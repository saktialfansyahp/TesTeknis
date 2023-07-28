<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Mobil;
use App\Models\Motor;
use App\Models\Kendaraan;

class KendaraanRepository
{
    private Kendaraan $kendaraan;
    private Mobil $mobil;
    private Motor $motor;
	public function __construct()
	{
		$this->kendaraan = new Kendaraan();
		$this->mobil = new Mobil();
        $this->motor = new Motor();
	}
    public function getAll() : Object
    {
        $mobil = Mobil::with('kendaraan')->get();
        $motor = Motor::with('kendaraan')->get();
        // $kendaraan = Kendaraan::get();
        $kendaraan = $mobil->merge($motor);
        return $kendaraan;
    }
    public function getById($id)
	{
		$task = User::with('kendaraan')->find($id);
		return $task;
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
