<?php

namespace App\Http\Controllers\API;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
 public function index()
 {
     $mater=Material::with('tests')->get();
     return response()->json([
       "status"=>200,
        "data"=>$mater
     ]);
 }

 public function store(Request $request)
 {
        dd($request->all());
        $validated=$request->validate([
                "grade_id"=>"exists:grades,id",
                "term"=>['required',Rule::in(['ترم_أول','ترم_ثاني'])],
                "title"=>"string|required",
                "photo"=>"nullable|image|mimes:png,jpg",
        ]);
        if($request->hasFile('photo')){
            $validated['photo']= $request->file('photo')->store('materials','image');
        }
        $material =Material::create($validated);
        return response()->json([
            "status"=>200,
            "data"=>$material
        ]);
 }
}
