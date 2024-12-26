<?php

namespace App\Http\Controllers\API;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
    {
        $grades=Grade::with('materials','tests')->get();
        return response()->json([
            "status"=>200,
            "data"=>$grades
        ],200);
    }
}
