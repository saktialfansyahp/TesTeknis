<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\MotorService;

class MotorController extends Controller
{
    private MotorService $motorService;
	public function __construct() {
		$this->motorService = new MotorService();
	}

    public function byId($id)
    {
        try {
            $result = $this->motorService->getById($id);
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
            $result = $this->motorService->getAll();
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
            $result['data'] = $this->motorService->store($data);
        } catch (Exception $e) {
            $result = [
                'status' =>'422',
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
	}

	public function updateMotor(Request $request, $id)
	{
		$data = $request->all();

        $updatedMotor = $this->motorService->update($id, $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Motor updated successfully',
            'data' => $updatedMotor,
        ], 200);
	}


	public function delete($id)
	{
        $this->motorService->delete($id);

		return response()->json([
			'message'=> 'Success delete motor '.$id
		]);
	}
}
