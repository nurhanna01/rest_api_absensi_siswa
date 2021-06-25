<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class AuthController extends Controller
{
    //login form
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = [
            'nim'=>$request->nim,
            'password'=>$request->password
        ];
        $siswa = Siswa::where('nim','=',$request->nim)->first();

        if(auth()->attempt($data)){
            $token=$siswa->createToken('token_siswa');
            return response()->json(['success'=>'berhasil login','token'=>$token],200);
        }else{
            return response()->json(['error'=>'gagal login'],401);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json(['message'=>'berhasil logout'],200);
    }

}
