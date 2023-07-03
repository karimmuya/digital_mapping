<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use App\Models\Portion;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
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


        $data = [
            ['x' => 1, 'y' => 5],
            ['x' => 2, 'y' => 10],
            ['x' => 3, 'y' => 8],
            ['x' => 4, 'y' => 15]
        ];
    

        return view('admin.index',  compact('data'))->with('users', $users)->with('portions', $portions)->with('notifications', $notifications)->with('lands', $lands);
    }



}
