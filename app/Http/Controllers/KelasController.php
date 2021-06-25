<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas=Kelas::all();
        return response()->json([
            'success'=>'berhasil',
            'message'=>'semua kelas',
            'data'=>$kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kelas' => 'required|unique',
            'nama_kelas'=> 'required',
        ]);

        $kelas = new Kelas([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas'=> $request->nama_kelas,
        ]);
        $kelas->save();

        return response()->json(['message'=>'kelas berhasil dibuat','data'=>$kelas],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas=Kelas::where('id','=',$id)->with('siswa')->get();
        return response()->json([
            'message'=>'detail kelas',
            'data'=>$kelas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $kelas = Kelas::findOrFail($id);
            $kelas->kode_kelas= $request->kode_kelas;
            $kelas->nama_kelas= $request->nama_kelas;

            $kelas->save();
            return response()->json(['message'=>'kelas berhasil diedit','data'=>$kelas],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
