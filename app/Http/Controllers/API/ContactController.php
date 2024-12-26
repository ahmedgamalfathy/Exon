<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
      $contacts= Contact::paginate();
      return response()->json([
        "status"=>200,
        "data"=>$contacts,
      ]);
    }
    public function store(Request $request)
    {
       $validated = $request->validate([
           "name"=>'string|required',
           "email"=>'string|required',
           "des"=>'nullable|string'
        ]);
       $contact =Contact::create($validated);
       return response()->json([
           "status"=>200,
           "data"=>$contact
       ]);
    }
    public function delete($id)
    {
      $contact = Contact::findOrFail($id);
      $contact->delete();
      return response()->json([
          "status"=>200,
          "msg"=>"تم الحذف بنجاح"
      ],200);
    }

}
