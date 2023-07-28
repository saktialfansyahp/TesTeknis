<?php

namespace App\Services;

use App\Repositories\MobilRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MobilService{
    private MobilRepository $mobilRepository;
	public function __construct()
	{
		$this->mobilRepository = new MobilRepository();
	}
    public function getAll()
    {
        $mobil = $this->mobilRepository->getAll();
        return $mobil;
    }
    public function getById($id)
	{
		$task = $this->mobilRepository->getById($id);
		return $task;
	}
    public function store($data) : Object
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'mesin' => 'required',
            'kapasitas_penumpang' => 'required',
            'tipe' => 'required',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->mobilRepository->store($data);
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
        $mobil = $this->mobilRepository->getById($id);
        if (!$mobil) {
            return response()->json(['error' => 'Mobil not found'], 404);
        }
        $this->mobilRepository->update($data, $id);
        return $mobil->fresh();
    }
    public function delete($id)
    {
        if(!$id)
		{
			return response()->json([
				'error' => 'Mobil not found'
			], 404);
		}
        $this->mobilRepository->delete($id);
    }
}
