<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\MobilService;

class MobilController extends Controller
{
    private MobilService $mobilService;
	public function __construct() {
		$this->mobilService = new MobilService();
	}

    public function byId($id)
    {
        try {
            $result = $this->mobilService->getById($id);
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
            $result = $this->mobilService->getAll();
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
            $result['data'] = $this->mobilService->store($data);
        } catch (Exception $e) {
            $result = [
                'status' =>'422',
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
	}

	public function updateMobil(Request $request, $id)
	{
		$data = $request->all();

        $updatedMobil = $this->mobilService->update($id, $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Mobil updated successfully',
            'data' => $updatedMobil,
        ], 200);
	}


	public function delete($id)
	{
        $this->mobilService->delete($id);

		return response()->json([
			'message'=> 'Success delete mobil '.$id
		]);
	}
}
