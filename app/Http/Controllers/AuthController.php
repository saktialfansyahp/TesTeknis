<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private AuthService $authService;
	public function __construct() {
		$this->authService = new AuthService();
	}
    public function register(Request $request)
    {
        $data = $request->all();

        $result = ['status' => 201];

        try {
            $result['data'] = $this->authService->register($data);
        } catch (Exception $e) {
            $result = [
                'status' =>'422',
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
    }
    public function login(){
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if(!$token){
            return response()->json(['error'=>'Invalid Email or Password'], 401);
        }
        $data = $this->authService->getAll();
        $token = JWTAuth::attempt($credentials, ['expires_in' => 3600]);

        return response()->json([
            'data' => $data,
            'access_token' => $token,
        ]);
    }
    public function logout(){
        auth()->logout();

        JWTAuth::invalidate();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
    public function refresh(){
        return response()->json([
            'access_token' => JWTAuth::refresh(JWTAuth::getToken()),
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
    public function data(){
        $auth = $this->authService->getAll();
		return response()->json($auth);
    }
    public function dataUser(){
        $auth = $this->authService->getUser();
		return response()->json($auth);
    }
    public function update(Request $request, $id){

        $data = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'role' => $request->input('role')
        ];

        $users = User::find($id);
        $users->update($data);

        return response()->json([
            'users' => $users,
        ]);
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
    }
}
