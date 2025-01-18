<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins=Admin::all();
        return view('Dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required|string',
            'email'=>'required|email|max:254',
            'password'=>['required',Password::min(6),'confirmed'],
            'photo'=>'nullable|image|mimes:jpeg,png,jpg'
        ]);
        $data['password']=Hash::make(Request()->post('password'));
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('admins','image');
            $data['photo']= $filePath;
        }
        $admin=Admin::create($data);
        // Auth::guard('admin')->login($admin);
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('Dashboard.admins.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('Dashboard.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $admin)
    {
        $data=request()->validate([
            'name'=>'required|string',
            'email'=>'required|email|max:254',
            'password'=>['nullable',Password::min(6),'confirmed'],
            'photo'=>'nullable|image|mimes:jpeg,png,jpg'
        ]);
        $admin_update=Admin::findOrFail($admin);
        if(request()->has('password')){
            $data['password'] =Hash::make(request('password'));
        }
        if ($request->hasFile('photo')) {
            if ($admin_update->photo) {
                Storage::disk('image')->delete($admin_update->photo);
            }
            $filePath = $request->file('photo')->store('admins','image');
            $data['photo']= $filePath;
        }
        $admin_update->update($data);
        // Auth::guard('admin')->login($admin);
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return back();
    }

}
