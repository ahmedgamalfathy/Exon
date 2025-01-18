<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function is_approve()
    {
        $Users=User::where('is_approve',0)->get();
        return view('dashboard.teacher.isApprove',compact('Users'));
    }
    public function showIsApprove($id)
    {
        $photos=User::where('id',$id)->select('photo','id')->first();
        return view('dashboard.teacher.showIsApp',compact('photos'));
    }
    public function changeStatus($id)
    {
        $user=User::findOrfail($id);
        $user->is_approve = 1;
        $user->save();
        return redirect()->route('teacher.isApprove');
    }
    public function approved()
    {
        $Users=User::where('is_approve',1)->get();
        return view('dashboard.teacher.approved',compact('Users'));
    }
}
