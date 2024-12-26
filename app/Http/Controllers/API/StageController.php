<?php

namespace App\Http\Controllers\API;

use App\Models\Stage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StageController extends Controller
{
    public function index(){
        $stages=Stage::with('grades')->get();
        return response()->json([
            "status"=>200,
            "data"=>$stages
        ]);
    }
}
