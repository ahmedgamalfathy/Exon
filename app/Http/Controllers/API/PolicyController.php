<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
        public function index()
        {
          $policys= Policy::paginate();
          return response()->json([
            "status"=>200,
            "data"=>$policys,
          ]);
        }
        public function store(Request $request)
        {
           $validated = $request->validate([
               "title"=>'string|required',
               "des"=>'nullable|string'
            ]);
           $policy =Policy::create($validated);
           return response()->json([
               "status"=>200,
               "data"=>$policy
           ]);
        }
        public function delete($id)
        {
          $policy = Policy::findOrFail($id);
          $policy->delete();
          return response()->json([
              "status"=>200,
              "msg"=>"تم الحذف بنجاح"
          ],200);
        }

}
