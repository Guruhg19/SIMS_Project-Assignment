<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function doLogin(Request $request){
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if(Auth::attempt($data)){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('login')->withErrors('Username atau Password tidak sesuai')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
