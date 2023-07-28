<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\KendaraanService;

class KendaraanController extends Controller
{
    private KendaraanService $kendaraanService;
	public function __construct() {
		$this->kendaraanService = new KendaraanService();
	}

    public function byId($id)
    {
        try {
            $result = $this->kendaraanService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

	public function get()
	{
		try {
            $result = $this->kendaraanService->getAll();
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

	public function create(Request $request)
	{
        $data = $request->all();

        $result = ['status' => 201];

        try {
            $result['data'] = $this->kendaraanService->store($data);
        } catch (Exception $e) {
            $result = [
                'status' =>'422',
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
	}

	public function updateKendaraan(Request $request, $id)
	{
		$data = $request->all();

        $updatedKendaraan = $this->kendaraanService->update($id, $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Kendaraan updated successfully',
            'data' => $updatedKendaraan,
        ], 200);
	}


	public function deleteKendaraan($id)
	{
        $this->kendaraanService->delete($id);

		return response()->json([
			'message'=> 'Success delete kendaraan '.$id
		]);
	}
}
