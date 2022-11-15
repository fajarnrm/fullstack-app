<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        //validasi untuk login
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //jika validasi selesai akan melakukan pengecekan email dan password dengan database
        $user = User::where('email',$data['email'])->first();
        if(!$user||!Hash::check($data['password'],$user->password)){
            return Response([
                'error_message' => 'Password atau Email Salah!'
            ],401);
        };
        //step ini anak dilalui jika pengecekan code diatas selesai
        $token = $user->createToken('main')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        //data dikirimkan jika nanti diperlukan di client
        return response($response,200);
        
    }

    public function register(Request $request){
        //validasi untuk register
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        //jika validasi lolos maka insert ke database
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        //inisialisasi atau pembuatan token
        $token = $user->createToken('main')->plainTextToken;
        //informasi login ditampung di var response
        $response = [
            'user' => $user,
            'token' => $token
        ];
        //data dikirimkan jika nanti diperlukan di client
        return response($response, 201);
    }

    public function logout(){
        //get data yang sedang login
        $user = Auth::user();
        //menghapus token akses
        $user->currentAccessToken()->delete();
        //memberikan informasi JSON ke client bahwa token berhasil dihapus
        return response([
            'success' => true
        ]);
    }
}
