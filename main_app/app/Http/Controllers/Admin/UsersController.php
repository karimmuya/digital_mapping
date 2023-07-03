<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use App\Models\Portion;
use App\Models\User;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
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


        return view('admin.users')->with('users', $users)->with('portions', $portions)->with('notifications', $notifications)->with('lands', $lands);
    }



    public function store(Request $request)
    {
        $user = new user;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password  = Hash::make($request->input('password'));
        $user->save();
        return redirect()->back()->with('success', 'User Added');
    }


    public function show($id)
    {
        $user = User::find($id);
        $portions = Portion::where('user_id', $id)->orderBy('status', 'DESC')->get();
        $notifications = Notification::where('user_id', $id)->get();
        return view('admin.edituser')->with('user', $user)->with('portions', $portions)->with('notifications', $notifications);
    }



    public function edit($id)
    {
        $user = User::find($id);
        $portions = Portion::where('user_id', $id)->get();
        return view('admin.edituser')->with('user', $user)->with('portions', $portions);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'profile_pic' => 'image|nullable|max:1999'
        ]);


        $user = User::find($id);

        if ($request->file('profile_pic')) {

            $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('profile_pic')->storeAs('public/profile_pics', $fileNameToStore);
            $user->profile_pic = $fileNameToStore;
        } else {
            $user->profile_pic = $user->profile_pic;
        }



        if ($request->input('username')) {
            $user->name = $request->input('username');
        } else {
            $user->name = $user->name;
        }

        if ($request->input('email')) {
            $user->email = $request->input('email');
        } else {
            $user->email = $user->email;
        }

        if ($request->input('role') == 'admin') {
            $user->role = 'admin';
            $user->is_admin = '1';
        } elseif ($request->input('role') == 'user') {
            $user->role = 'user';
            $user->is_admin = '0';
        }

        if ($request->input('acc_num')) {
            $user->acc_num = $request->input('acc_num');
        } else {
            $user->acc_num = $user->acc_num;
        }


        $user->save();
        return redirect()->back()->with('success', 'Profile Edited');
    }



    public function destroy($id)
    {
        $user = User::find($id);
        $portions = Portion::where('user_id', $user->id)->get();
        foreach ($portions as $portion) {

            $payments = Payment::where('portion_id', $portion->id)->get();
            foreach ($payments as $payment) {
                $payment->delete();
            }


            $portion->user_id = null;
            $portion->fill = null;
            $portion->status = "released";
            $portion->bought_by = null;
            $portion->save();
        }



        $notifications = Notification::where('user_id', $user->id)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }


        $user->delete();

        return redirect()->back()->with('success', 'User Deleted');
    }
}
