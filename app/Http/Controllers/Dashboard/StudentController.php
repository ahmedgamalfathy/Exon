<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $users=User::where('applier','طالب')->get();
        return view('dashboard.student.index',compact('users'));
    }
}
