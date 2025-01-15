<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth/login");
    }

    public function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required' => 'Email Wajib Diisi!',
            'password.required' => 'Password Wajib Diisi!',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($infologin)){
            //Otentikasi sukses
            return redirect('puskesmas')->with('success', 'Berhasil Login!');
        } else {
            //Otentikasi gagal
            Session::flash('error', 'Email atau Password salah');
            return redirect('auth')->withErrors('Username dan Password yang dimasukan tidak valid');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('auth')->with('success', 'Berhasil Logout!');
    }
    
}
