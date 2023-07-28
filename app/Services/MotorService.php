<?php

namespace App\Services;

use App\Repositories\MotorRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MotorService{
    private MotorRepository $motorRepository;
	public function __construct()
	{
		$this->motorRepository = new MotorRepository();
	}
    public function getAll()
    {
        $motor = $this->motorRepository->getAll();
        return $motor;
    }
    public function getById($id)
	{
		$task = $this->motorRepository->getById($id);
		return $task;
	}
    public function store($data) : Object
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'mesin' => 'required',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->motorRepository->store($data);
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
        $motor = $this->motorRepository->getById($id);
        if (!$motor) {
            return response()->json(['error' => 'Motor not found'], 404);
        }
        $this->motorRepository->update($data, $id);
        return $motor->fresh();
    }
    public function delete($id)
    {
        if(!$id)
		{
			return response()->json([
				'error' => 'Motor not found'
			], 404);
		}
        $this->motorRepository->delete($id);
    }
}
