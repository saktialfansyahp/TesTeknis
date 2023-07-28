<?php

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Motor;

class MotorRepository
{
    private Kendaraan $kendaraan;
    private Motor $motor;
	public function __construct()
	{
        $this->kendaraan = new Kendaraan();
		$this->motor = new Motor();
	}
    public function getAll() : Object
    {
        $motor = Motor::with('kendaraan')->get();
        return $motor;
    }
    public function getById($id)
	{
		$task = User::with('motor')->find($id);
		return $task;
	}
    public function store($data) : Object
    {
        $dataBaru = new $this->kendaraan;
        $dataBaru->tahun_keluaran = $data['tahun_keluaran'];
        $dataBaru->warna = $data['warna'];
        $dataBaru->harga = $data['harga'];
        $dataBaru->save();
        $motor = new $this->motor;
        $motor->mesin = $data['mesin'];
        $motor->tipe_suspensi = $data['tipe_suspensi'];
        $motor->tipe_transmisi = $data['tipe_transmisi'];
        $motor->kendaraan_id = $dataBaru->id;
        $motor->save();
        return $motor->fresh();
    }
    public function update($data, $id)
    {
        $motor = Motor::find($id);
        $motor->update($data);
    }
    public function delete($id)
	{

        $kendaraan = Kendaraan::find($id);
        $motor = Motor::where('kendaraan_id', $kendaraan->_id)->first();
        if ($motor) {
            $motor->delete();
        }
		$kendaraan->delete();
        return "Motor Deleted";
	}
    public function save(Motor $motor, array $data)
    {
        $motor->update($data);
        return $motor;
    }
}
