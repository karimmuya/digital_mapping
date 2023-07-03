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
use Illuminate\Support\Facades\Hash;


class PaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $payments = Payment::orderBy('status', 'ASC')->get();
        $portions = Portion::all();
        return view('admin.payments')->with('payments', $payments)->with('portions', $portions);
    }

}
