<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class KendaraanService{
    private KendaraanRepository $kendaraanRepository;
	public function __construct()
	{
		$this->kendaraanRepository = new KendaraanRepository();
	}
    public function getAll()
    {
        $kendaraan = $this->kendaraanRepository->getAll();
        return $kendaraan;
    }
    public function getById($id)
	{
		$task = $this->kendaraanRepository->getById($id);
		return $task;
	}
    public function store($data) : Object
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->kendaraanRepository->store($data);
        return $result;
    }
    public function update($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'no_telp' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'status' => 'required',
            'jenis' => 'required'
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $kendaraan = $this->kendaraanRepository->getById($id);
        if (!$kendaraan) {
            return response()->json(['error' => 'Kendaraan not found'], 404);
        }
        $this->kendaraanRepository->update($data, $id);
        return $kendaraan->fresh();
    }
    public function delete($id)
    {
        if(!$id)
		{
			return response()->json([
				'error' => 'Kendaraan not found'
			], 404);
		}
        // $task = $this->kendaraanRepository->delete($id);
        // return $task;
    }
}
