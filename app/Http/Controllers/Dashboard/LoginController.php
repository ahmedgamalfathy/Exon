<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    public function create(){
        return view('Dashboard.Auth.Login');
    }
    public function login(){
        $attributes =request()->validate([
            'email' =>['required','email'],
            'password'=>['required']
        ]);
        if(! Auth::guard('admin')->attempt($attributes)){
            throw ValidationException::withMessages([
                'email'=>'Sorry, those credentials do not match.'
            ]);
        }
        request()->session()->regenerate();
        return redirect()->route('home');
        }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('home');
    }
}
