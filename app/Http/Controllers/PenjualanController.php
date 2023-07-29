<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\MobilService;
use App\Services\MotorService;
use App\Services\PenjualanService;

class PenjualanController extends Controller
{
    private MobilService $mobilService;
    private MotorService $motorService;
    private PenjualanService $penjualanService;
	public function __construct() {
		$this->mobilService = new MobilService();
		$this->motorService = new MotorService();
        $this->penjualanService = new PenjualanService();
	}
    public function get()
	{
		try {
            $result = $this->penjualanService->getAll();
            if (count($result) === 0){
                $result = null;
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
	}
    public function getby($kendaraan)
	{
		try {
            $result = $this->penjualanService->getBy($kendaraan);
            if (count($result) === 0){
                $result = null;
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
	}
    public function stok(){
        $stokMobil = $this->mobilService->getAll();
        $stokMotor = $this->motorService->getAll();

        $response = [
            'status' => 'success',
            'message' => 'Data stok mobil dan motor berhasil diambil.',
            'data' => [
                'mobil' => $stokMobil,
                'motor' => $stokMotor,
            ],
        ];
        return response()->json($response, 200);
    }
    public function create(Request $request)
	{
        $data = $request->all();

        $result = ['status' => 201];

        try {
            $result['data'] = $this->penjualanService->store($data);
        } catch (Exception $e) {
            $result = [
                'status' =>'422',
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
	}
}
