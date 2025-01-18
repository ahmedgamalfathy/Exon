<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    public function update(Request $request, Admin $admin)
    {
        $data=request()->validate([
            'name'=>'required|string',
            'email'=>'required|email|max:254',
            'password'=>['nullable',Password::min(6),'confirmed']
        ]);
        $data['password']=Hash::make(Request()->post('password'));
        $admin=Admin::create($data);
        // Auth::guard('admin')->login($admin);
      return view('Dashboard.admins.show');
    }
}
