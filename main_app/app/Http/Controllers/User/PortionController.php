<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;


use App\Models\Portion;
use App\Models\Land;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PortionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }


    public function index()
    {
        $lands = Land::orderBy('id', 'asc')->paginate(6);
        return view('user.index')->with('lands', $lands);
    }



    public function show($land_id)
    {
        $portions = Portion::where('land_id', $land_id)->get();
        $land = Land::where('name', $land_id)->get();
        return view('user.portions')->with('portions', $portions)->with('land', $land);
    }




    public function update(Request $request, Portion $portion, Notification $notification)
    {
        $portion->user_id = Auth::user()->id;
        $due = Carbon::now();
        $due->addDays(3);
        $portion->due_date = $due;



        if ($request->fill) {
            $portion->fill = $request->fill;
        } else {
            $portion->fill = $portion->fill;
        }

        if ($request->status) {
            $portion->status = $request->status;
        } else {
            $portion->status = $portion->status;
        }

        if ($request->vector) {
            $portion->vector = $request->vector;
        } else {
            $portion->vector = $portion->vector;
        }

        $portion->bought_by = Auth::user()->name;
        $land = Land::where('name', $portion->land_id)->first();

        $payment = new Payment;

        $leadingDigit = rand(1, 9);
        $controllNumber = "9912" . $leadingDigit . str_pad(rand(0, 999999), 7, '0', STR_PAD_LEFT);

        $payment->control_num = $controllNumber;
        $payment->user_id = Auth::user()->id;
        $payment->portion_id = $portion->id;
        $payment->status = "not";

        $notification->user_id = Auth::user()->id;
        $notification->title = "Payment Procedures";
        $notification->desc = "You have just reserved a portion number " . $portion->id . ", You can now go ahead and pay using accont number " . $land->acc_num .  " . You have untill " . \Carbon\Carbon::parse($portion->due_date)->diffForHumans() . " to complete payments ";


        if (Auth::user()->id !== $portion->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Page');
        }

        $portion->save();
        $notification->save();
        $payment->save();
        return redirect()->back()->with('success', 'Portion reserved');
    }
}
