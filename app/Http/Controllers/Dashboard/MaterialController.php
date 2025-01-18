<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class MaterialController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials= Material::all();
        return view('dashboard.material.index',compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades=Grade::all();
        return view('dashboard.material.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            "term"=>['required',Rule::in(['ترم_أول','ترم_ثاني'])],
            "photo"=>'nullable|image|mimes:png,jpg,webg',
            "grade_id"=>'required|exists:stages,id',
            "title"=>'required|string'
        ]);
        if($request->hasFile('photo')){
         $data['photo'] = $request->file('photo')->store('materials','image');
        }
        Material::create($data);
        return redirect()->route('material.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $grades=Grade::all();
        $material=Material::findOrFail($id);
        return view('dashboard.material.edit',compact('material','grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $material=Material::findOrFail($id);
        $data=$request->validate([
            "term"=>['required',Rule::in(['ترم_أول','ترم_ثاني'])],
            "photo"=>'nullable|image|mimes:png,jpg,webg',
            "grade_id"=>'required|exists:stages,id',
            "title"=>'required|string'
        ]);
        if ($request->hasFile('photo')) {
            if ($material->photo) {
                Storage::disk('image')->delete($material->photo);
            }
            $filePath = $request->file('photo')->store('materials','image');
            $data['photo']= $filePath;
        }
        $material->update($data);
       return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material=Material::findOrFail($id);
        $material->delete();
        return redirect()->route('material.index');
    }
}
