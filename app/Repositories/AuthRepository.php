<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Pelanggan;
use App\Services\PelangganService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository{
    private User $user;
	public function __construct()
	{
		$this->user = new User();
	}
    public function register($data){
        $user = new $this->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user->fresh();
    }
    public function getAll()
    {
        $auth = auth()->user();
        return $auth;
    }
    public function getuser(){
        $auth = User::all();
        return $auth;
    }
}
