<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $tanggal=$now->format('Y-m-d');
        $absenhariini=Absen::where('tanggal','=',$tanggal)->get();
        return response()->json([
            'message'=>'mahasiswa yang hadir hari ini',
            'data'=>$absenhariini
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $now = Carbon::now();
        $tanggal=$now->format('Y-m-d');

        $sudahAbsen=Absen::where([
            ['siswa_id','=',auth()->user()->id],
            ['tanggal','=',$tanggal]
            ])->first();

        if($sudahAbsen){
            return response()->json(['message'=>'Tidak dapat melakukan absen, Anda telah melakukan absen','data'=>$sudahAbsen],200);
        }else{
            $absen = new Absen([
                'siswa_id' => auth()->user()->id,
                'tanggal'=> $now,
            ]);
            $absen->save();
            return response()->json(['message'=>'berhasil absen','data'=>$absen],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absen=Absen::findOrFile($id);
        $absen->delete();
        return response()->json(['message'=>'Absen telah dibatalkan']);
    }
}
