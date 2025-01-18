<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    public function index()
    {
        $policys= Policy::all();
        return view('dashboard.policy.index',compact('policys'));
    }
    public function create()
    {
      return view('dashboard.policy.create');
    }
    public function edit($id)
    {
      $policy=  Policy::findOrFail($id);
      return view('dashboard.policy.edit',compact('policy'));

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title"=>'string|required',
            "des"=>'nullable|string'
         ]);
        Policy::create($validated);
        return redirect()->route('policys');
    }
    public function update($id,Request $request)
    {
        $policy=Policy::find($id);
        $validated = $request->validate([
            "title"=>'string|required',
            "des"=>'nullable|string'
         ]);
        $policy =$policy->update($validated);
        return redirect()->route('policys');
    }
    public function delete($id)
    {
      $policy = Policy::findOrFail($id);
      $policy->delete();
      return redirect()->route('policys');
    }

}
