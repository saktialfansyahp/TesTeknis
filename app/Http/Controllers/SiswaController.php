<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(){
        $siswa = Siswa::get();
        return response()->json([
            'message' => 'Success',
            'siswa' => $siswa
        ],200);
    }
    public function create(Request $request){
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required',
            'gender' => 'required',
            'kelas_id' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json('Data yang anda masukkan tidak valid', 400);
        }
        $siswa = Siswa::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'gender' => $request->gender,
            'kelas_id' => $request->kelas_id,
        ]);
        return response()->json([
            'message' => 'siswa berhasil dibuat',
            'siswa' => $siswa
        ],200);
    }
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required',
            'gender' => 'required',
            'kelas_id' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->error(), 400);
        }
        $siswa = Siswa::where('_id', $id)->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'gender' => $request->gender,
            'kelas_id' => $request->kelas_id,
        ]);

        return response()->json([
            'message' => 'siswa berhasil diupdate',
            'siswa' => $siswa
        ],200);
    }
    public function getSiswa(){
        $kelas = Siswa::with('matapelajaran', 'nilai')->get();
        return response()->json([
            'message' => 'Success',
            'kelas' => $kelas
        ],200);
    }
}
