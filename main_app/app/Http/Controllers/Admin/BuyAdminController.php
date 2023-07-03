<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use App\Models\Portion;
use App\Models\User;
use App\Models\Notification;
use App\Models\Payment;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BuyAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
    }


    public function show($name)
    {
    }



    public function edit(Portion $portion, $name)
    {
    }


    public function release($id)
    {

        $portion = Portion::find($id);
        $payment = Payment::where('portion_id', $portion->id)->first();

        $notifications = Notification::where('user_id', $portion->user_id)->where('portion_id', $portion->id)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }

        $portion->user_id = null;
        $portion->fill = null;
        $portion->bought_by = null;
        $portion->status = "released";
        $portion->save();

        $payment->delete();
        return redirect()->back()->with('success', 'Portion Relased');
    }


    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'num' => 'required'

        // ]);


        $portion = Portion::where('id', $id)->first();
        $payment = Payment::where('portion_id', $portion->id)->first();
        $portion->bought_by = $portion->user_id;
        $portion->status = "taken";
        $portion->fill = "red";
        $payment->amount = $request->input('amount') + $payment->amount;
        if ($payment->amount >= $portion->price) {
            $payment->status = "full";
        } else if ($payment->amount < $portion->price) {
            $payment->status = "half";
        } else if ($payment->amount < 0) {
            $payment->status = "not";
        }

        $user = User::where('id', $portion->user_id)->first();
        $payment->payslip = null;
        $portion->save();
        $payment->save();


        return redirect('manage_users/' . $user->id . '#panel2')->with('success', 'Payment Reviewed');
    }
}
