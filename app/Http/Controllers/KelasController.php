<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Mongodb\Collection;

class KelasController extends Controller
{
    public function index(){
        $kelas = Kelas::get();
        return response()->json([
            'message' => 'Success',
            'kelas' => $kelas
        ],200);
    }
    public function create(Request $request){
        $validatedData = Validator::make($request->all(), [
            'class' => 'required',
            'studyProgram' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json('Data yang anda masukkan tidak valid', 400);
        }
        $kelas = Kelas::create([
            'class' => $request->class,
            'studyProgram' => $request->studyProgram
        ]);
        return response()->json([
            'message' => 'Kelas berhasil dibuat',
            'kelas' => $kelas
        ],200);
    }
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(), [
            'class' => 'required',
            'studyProgram' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->error(), 400);
        }
        $kelas = Kelas::where('_id', $id)->update([
            'class' => $request->class,
            'studyProgram' => $request->studyProgram,
        ]);

        return response()->json([
            'message' => 'Kelas berhasil diupdate',
            'kelas' => $kelas
        ],200);
    }
    public function getDetailClass(){
        $kelas = Kelas::with('siswa')->get();
        return response()->json([
            'message' => 'Success',
            'kelas' => $kelas
        ],200);
    }
}
