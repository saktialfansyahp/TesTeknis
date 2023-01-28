<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index(){
        $nilai = Nilai::get();
        return response()->json([
            'message' => 'Success',
            'nilai' => $nilai
        ],200);
    }
    public function create(Request $request){
        $validatedData = Validator::make($request->all(), [
            'latsol_1' => 'required',
            'latsol_2' => 'required',
            'latsol_3' => 'required',
            'latsol_4' => 'required',
            'uh_1' => 'required',
            'uh_2' => 'required',
            'uts' => 'required',
            'us' => 'required',
            'siswa_id' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json('Data yang anda masukkan tidak valid', 400);
        }
        $nilai = Nilai::create([
            'latsol_1' =>$request->latsol_1,
            'latsol_2' =>$request->latsol_2,
            'latsol_3' =>$request->latsol_3,
            'latsol_4' =>$request->latsol_4,
            'uh_1' => $request->uh_1,
            'uh_2' => $request->uh_2,
            'uts' => $request->uts,
            'us' => $request->us,
            'siswa_id' => $request->siswa_id,
        ]);
        return response()->json([
            'message' => 'nilai berhasil dibuat',
            'nilai' => $nilai
        ],200);
    }
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(), [
            'latsol_1' => 'required',
            'latsol_2' => 'required',
            'latsol_3' => 'required',
            'latsol_4' => 'required',
            'uh_1' => 'required',
            'uh_2' => 'required',
            'uts' => 'required',
            'us' => 'required',
            'siswa_id' => 'required',
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->error(), 400);
        }
        $nilai = Nilai::where('_id', $id)->update([
            'latsol_1' =>$request->latsol_1,
            'latsol_2' =>$request->latsol_2,
            'latsol_3' =>$request->latsol_3,
            'latsol_4' =>$request->latsol_4,
            'uh_1' => $request->uh_1,
            'uh_2' => $request->uh_2,
            'uts' => $request->uts,
            'us' => $request->us,
            'siswa_id' => $request->siswa_id,
        ]);

        return response()->json([
            'message' => 'nilai berhasil diupdate',
            'nilai' => $nilai
        ],200);
    }
    public function getNilai(){
        $nilai = Nilai::with('siswa','matapelajaran')->get();
        return response()->json([
            'message' => 'Success',
            'nilai' => $nilai
        ],200);
    }
}
