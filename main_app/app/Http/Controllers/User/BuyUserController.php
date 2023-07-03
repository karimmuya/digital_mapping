<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Portion;
use App\Models\Payment;
use App\Models\Notification;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BuyUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function release($id)
    {

        $portion = Portion::find($id);
        if (Auth::user()->id !== $portion->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Page');
        }
        $payment = Payment::where('portion_id', $portion->id)->first();
        $notifications = Notification::where('user_id', $portion->user_id)->where('portion_id', $portion->id)->get();
        if (count($notifications) > 0) {
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        }
        $portion->user_id = null;
        $portion->fill = null;
        $portion->status = "released";
        $portion->bought_by = null;
        $portion->save();
        $payment->delete();
        return redirect('/profile#panel2')->with('success', 'Portion Relased');
    }



    public function upload(Request $request, $id)
    {

        $payments = Payment::where('portion_id', $id)->first();

        if ($request->file('payslip')) {

            $fileNameWithExt = $request->file('payslip')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('payslip')->getClientOriginalExtension();
            $fileNameToStore = Auth::user()->name . '_' . time() . '.' . $extension;
            $request->file('payslip')->storeAs('public/payslips', $fileNameToStore);
            $payments->payslip = $fileNameToStore;
            $payments->save();
        }



        return redirect('/profile#panel2')->with('success', 'Receipt Uploaded');
    }
}
