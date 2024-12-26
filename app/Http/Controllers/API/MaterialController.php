<?php

namespace App\Http\Controllers\API;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
 public function index()
 {
     $mater=Material::all();
     return response()->json([
       "status"=>200,
        "data"=>$mater
     ]);
 }
}
