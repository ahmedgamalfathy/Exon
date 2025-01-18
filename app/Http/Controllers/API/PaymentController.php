<?php

namespace App\Http\Controllers\API;

use App\Models\Test;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(int $test,Request $request)
    {
    DB::beginTransaction();
       $user= Auth::user();
       $test=Test::findOrfail($test);
       if(!$test){
        return response()->json(['data'=>"هذا الاختبار مش موجود"],404);
       }
       Payment::create([
           "user_id"=>$user->id,
           "test_id"=>$test->id,
           "amount"=>$test->price,
           "payment_method"=>$request->PaymentMethod
       ]);
       DB::commit();
       return response()->json(['message'=>"الطلب قيد المراجعة"],200);
      //notfication to admin and to teatcher
    }
    public function teachercosts()
    {
        $totals = User::with(['tests' => function ($query) {
            $query->withSum('payments', 'amount');
        }])->get();

        $data =[];
        foreach ($totals as $teacher) {
            $totalAmount = $teacher->tests->sum('payments_sum_amount');
               $TeacherAmounts =[
                       "teacher_id"=>$teacher->id,
                       "totalAmount"=>$totalAmount
                    ];
                    array_push($data,$TeacherAmounts);
           return response()->json([
               "data"=>$TeacherAmounts
           ],200);
        }
    }



}
