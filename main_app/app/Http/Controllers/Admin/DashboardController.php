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
    

        return view('admin.index')->with('users', $users)->with('portions', $portions)->with('notifications', $notifications)->with('lands', $lands);
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
    }


    public function show($land_id)
    {
    }



    public function edit(Portion $portion)
    {
    }


    public function update(Request $request, $id)
    {
    }

    public function destroy(Portion $portion)
    {
    }
}
