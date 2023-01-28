<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function index(){
        $mapel = MataPelajaran::get();
        return response()->json([
            'message' => 'Success',
            'mapel' => $mapel
        ],200);
    }
    public function create(Request $request){
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'siswa_id' => 'required',
        ]);
        if($validatedData->fails()){
            return response()->json('Data yang anda masukkan tidak valid', 400);
        }
        $mapel = MataPelajaran::create([
            'name' => $request->name,
            'siswa_id' => $request->siswa_id,
        ]);
        return response()->json([
            'message' => 'mapel berhasil dibuat',
            'mapel' => $mapel
        ],200);
    }
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'siswa_id' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->error(), 400);
        }
        $mapel = MataPelajaran::where('_id', $id)->update([
            'name' => $request->name,
            'siswa_id' => $request->siswa_id,
        ]);

        return response()->json([
            'message' => 'mapel berhasil diupdate',
            'mapel' => $mapel
        ],200);
    }
    public function getMapel(){
        $mapel = MataPelajaran::with('nilai')->get();
        return response()->json([
            'message' => 'Success',
            'mapel' => $mapel
        ],200);
    }
}
