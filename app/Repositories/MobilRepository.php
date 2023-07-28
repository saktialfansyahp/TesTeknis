<?php

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Mobil;

class MobilRepository
{
    private Kendaraan $kendaraan;
    private Mobil $mobil;
	public function __construct()
	{
        $this->kendaraan = new Kendaraan();
		$this->mobil = new Mobil();
	}
    public function getAll() : Object
    {
        $mobil = Mobil::with('kendaraan')->get();
        return $mobil;
    }
    public function getById($id)
	{
		$task = User::with('mobil')->find($id);
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
        $mobil = Mobil::find($id);
        $mobil->update($data);
    }
    public function delete($id)
	{

        $kendaraan = Kendaraan::find($id);
        $mobil = Mobil::where('kendaraan_id', $kendaraan->_id)->first();
        if ($mobil) {
            $mobil->delete();
        }
		$kendaraan->delete();
        return "Mobil Deleted";
	}
    public function save(Mobil $mobil, array $data)
    {
        $mobil->update($data);
        return $mobil;
    }
}
