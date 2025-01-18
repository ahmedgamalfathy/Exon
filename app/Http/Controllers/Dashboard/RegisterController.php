<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function create()
    {
      return view('Dashboard.Auth.Register');
    }
    // public function store(Request $request){
    //     dd('ssds');
    //     $data=$request->validate([
    //         'name'=>'required',
    //         'email'=>'required|email|unique|max:254',
    //         'password'=>['required',Password::min(6)],
    //         'photo'=>'nullable|image|mimes:jpeg,png,jpg'
    //         //    'password'=>['required',Password::min(5)->numbers()->letters(),Password::default]
    //     ]);
    //     $data['password']= Hash::make(Request()->post('password'));
    //     $admin=Admin::create($data);
    //     // Auth::guard('admin')->login($admin);
    //     return redirect()->route('login') ;
    //     }
}
