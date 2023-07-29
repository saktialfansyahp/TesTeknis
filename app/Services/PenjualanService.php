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
    public function getBy($kendaraan)
	{
        $kendaraan = strtolower($kendaraan);

        if ($kendaraan !== 'motor' && $kendaraan !== 'mobil') {
            throw new InvalidArgumentException('Nilai kendaraan harus berisi "motor" atau "mobil".');
        }
		$task = $this->penjualanRepository->getBy($kendaraan);
		return $task;
	}
    public function store($data) : Object
    {
        $validator = Validator::make($data, [
            'kendaraan_id' => 'required',
            'jumlah_terjual' => 'required',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->penjualanRepository->store($data);
        return $result;
    }
}
