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


class AdminSearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }



    public function usersearch(Request $request)
    {
        $search = $request->input('search');
        $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->get();


        return view('admin.usersearch', compact('users'));
    }

    public function landsearch(Request $request)
    {
        $search = $request->input('search');
        $lands = Land::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('region', 'LIKE', "%{$search}%")
            ->orWhere('district', 'LIKE', "%{$search}%")
            ->orWhere('stprice', 'LIKE', "%{$search}%")
            ->get();


        return view('admin.landsearch', compact('lands'));
    }




    public function paymentsearch(Request $request)
    {
        $search = $request->input('search');
        $payments = Payment::query()
            ->where('control_num', 'LIKE', "%{$search}%")
            ->orWhere('amount', 'LIKE', "%{$search}%")
            ->orWhere('user_id', 'LIKE', "%{$search}%")
            ->get();



        return view('admin.paymentsearch', compact('payments'));
    }
}
