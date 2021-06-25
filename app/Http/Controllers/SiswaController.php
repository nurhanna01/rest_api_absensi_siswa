<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa=Siswa::all();
        return response()->json([
            'success'=>'data siswa',
            'message'=>'data siswa',
            'data'=>$siswa
        ]);
        // return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
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
            'nim' => 'required|unique',
            'nama'=> 'required',
            'password'=>'required'
        ]);

        $siswa = new Siswa([
            'nim' => $request->nim,
            'nama'=> $request->nama,
            'password' => bcrypt($request->password)
            ]);
            
        $siswa->save();
        $token=$siswa->createToken('token_siswa');
            
        return response()->json(['success'=>'berhasil membuat user baru','token'=>$token],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa=Siswa::findOrFail($id)->where('id','=',$id)->with('kelas')->get();
        if($siswa){
            return response()->json([
                'success'=>'detail mahasiwa',
                'data_siswa'=>$siswa,
            ]);
        }else{
            return response()->json(['error'=>'user tidak terdaftar']);
        }
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
            $siswa = Siswa::findOrFail(auth()->user()->id);
            $siswa->nim= $request->nim;
            $siswa->nama= $request->nama;
            $siswa->password= bcrypt($request->password);

            if($siswa->save()){
                return response()->json(['success'=>'berhasil diedit','data'=>$siswa],200);
            }else{
                return response()->json(['error'=>'gagal mengedit'],200);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return response()->json(['message'=>'data siswa berhasil di hapus']);
    }

    public function joinkelas(Request $request)
    {
        $siswa=Siswa::findOrFail(auth()->user()->id);
        $kelas_id=$request->kelas_id;
        $check=$siswa->kelas()->where('kelas_id','=',$kelas_id)->exists();
        if(!$check){
            $siswa->kelas()->attach($kelas_id);
            return response()->json(['success'=>'Anda berhasil join ke kelas']);
        }else{
            return response()->json(['message'=>'Anda sudah join ke kelas']);
        }
        
    }
}
