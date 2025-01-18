<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function pending()
    {
        $pends=Payment::where('status','pending')->get();
        return view('dashboard.payments.pending',compact('pends'));
    }
    public function completed()
    {
        $completes=Payment::where('status','completed')->get();
        return view('dashboard.payments.completed',compact('completes'));
    }
    public function faild()
    {
        $faileds=Payment::where('status','failed')->get();
        return view('dashboard.payments.faild',compact('faileds'));
    }
    public function changecompleted($id)
    {
      $req=Payment::find($id);
      $req->status ="completed";
      $req->save();
      return redirect()->route('payment.pending');
    }
    public function changefaild($id)
    {
      $req=Payment::find($id);
      $req->status ="failed";
      $req->save();
      return redirect()->route('payment.pending');
    }
}
