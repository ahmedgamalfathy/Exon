<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Stage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $stages= Stage::all();
       return view('dashboard.stages.index',compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.stages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data=$request->validate([
            "title"=>'required|string'
        ]);
        Stage::create($data);
        return redirect()->route('stage.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $stage=Stage::findOrFail($id);
        return view('dashboard.stages.update',compact('stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $stage=Stage::findOrFail($id);
        $data=$request->validate([
            "title"=>'required|string'
        ]);
       $stage->update($data);
       return redirect()->route('stage.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $stage=Stage::findOrFail($id);
        $stage->delete();
        return redirect()->route('stage.index');
    }
}
