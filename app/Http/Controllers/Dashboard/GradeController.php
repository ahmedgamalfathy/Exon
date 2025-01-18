<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades= Grade::all();
        return view('dashboard.grades.index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stages=Stage::all();
        return view('dashboard.grades.create',compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            "stage_id"=>'required|exists:stages,id',
            "title"=>'required|string'
        ]);
        Grade::create($data);
        return redirect()->route('grade.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stages=Stage::all();
        $grade=Grade::findOrFail($id);
        return view('dashboard.grades.update',compact('grade','stages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $grade=Grade::findOrFail($id);
        $data=$request->validate([
            "stage_id"=>'required|exists:stages,id',
            "title"=>'required|string'
        ]);
       $grade->update($data);
       return redirect()->route('grade.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grade=Grade::findOrFail($id);
        $grade->delete();
        return redirect()->route('grade.index');
    }
}
