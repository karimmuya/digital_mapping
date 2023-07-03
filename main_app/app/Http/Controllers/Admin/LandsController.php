<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use App\Models\Portion;
use App\Models\User;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Http\Request;



class LandsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {

        $users = User::all();
        $lands = Land::all();
        $portions = Portion::all();
        $notifications = Notification::all();


        return view('admin.lands')->with('users', $users)->with('portions', $portions)->with('notifications', $notifications)->with('lands', $lands);
    }



    public function show($name)
    {
        $land = Land::where('name', $name)->get();
        $portions = Portion::where('land_id', $name)->get();
        return view('admin.editland')->with('land', $land)->with('portions', $portions);
    }



    public function edit(Portion $portion, $name)
    {
        $land = Land::where('name', $name)->get();
        $portions = Portion::where('land_id', $name)->get();
        return view('admin.editland')->with('land', $land)->with('portions', $portions);
    }


    public function update(Request $request, $id)
    {

        $land = Land::find($id);
        $land->region = $request->input('region');
        $land->district = $request->input('district');
        $land->pricepersqm = $request->input('pricepersqm');
        $land->stprice = $request->input('stprice');
        $land->pymnt_season = $request->input('pymnt_season');
        $land->phone = $request->input('phone');
        $land->mradi = $request->input('mradi');
        $land->name = $request->input('name');
        $land->lat = $request->input('lat');
        $land->long = $request->input('lng');
        $land->acc_num = $request->input('acc_num');
        $land->save();


        return redirect('/manage_lands')->with('success', 'Land Updated');
    }

    public function destroy($id)
    {
        $land = Land::find($id);
        $portions = Portion::where('land_id', $land->name)->get();
        foreach ($portions as $portion) {
            $payments = Payment::where('portion_id', $portion->id)->get();
            if (count($payments) > 0) {
                foreach ($payments as $payment) {
                    $payment->delete();
                }
            }


            $notifications = Notification::where('user_id', $portion->user_id)->get();
            if (count($notifications) > 0) {
                foreach ($notifications as $notification) {
                    $notification->delete();
                }
            }

            $portion->delete();
        }


        $land->delete();
        return redirect('/manage_lands')->with('success', 'Land Deleted');
    }
}
