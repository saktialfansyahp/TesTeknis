<?php

namespace App\Services;

use App\Repositories\PenjualanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PenjualanService{
    private PenjualanRepository $penjualanRepository;
	public function __construct()
	{
		$this->penjualanRepository = new PenjualanRepository();
	}
    public function getAll()
    {
        $penjualan = $this->penjualanRepository->getAll();
        return $penjualan;
    }
    public function getById($id)
	{
		$task = $this->penjualanRepository->getById($id);
		return $task;
	}
    public function store($data) : Object
    {
        $validator = Validator::make($data, [
            'kendaraan_id' => 'required',
            'harga' => 'required',
            'jumlah_terjual' => 'required',
            'total_harga' => 'required',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->penjualanRepository->store($data);
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
        $penjualan = $this->penjualanRepository->getById($id);
        if (!$penjualan) {
            return response()->json(['error' => 'Penjualan not found'], 404);
        }
        $this->penjualanRepository->update($data, $id);
        return $penjualan->fresh();
    }
    // public function delete($id)
    // {
    //     if(!$id)
	// 	{
	// 		return response()->json([
	// 			'error' => 'Penjualan not found'
	// 		], 404);
	// 	}
    //     $this->penjualanRepository->delete($id);
    // }
}
