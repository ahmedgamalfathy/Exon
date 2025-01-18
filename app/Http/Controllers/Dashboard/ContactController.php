<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
      $contacts= Contact::get();
      return view('dashboard.contactus.index',compact('contacts'));
    }
}
