<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Portion;
use App\Models\User;
use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $portions = Portion::where('user_id', $user_id)->orderBy('bought_by', 'DESC')->get();
        $notifications = Notification::where('user_id', $user_id)->paginate(10);


        return view('user.profile')->with('user', $user)->with('portions', $portions)->with('notifications', $notifications);
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

        if ($request->input('phone')) {
            $user->phone = $request->input('phone');
        } else {
            $user->phone = $user->phone;
        }

        if ($request->input('acc_num')) {
            $user->acc_num = $request->input('acc_num');
        } else {
            $user->acc_num = $user->acc_num;
        }


        if (Auth::user()->id !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized Page');
        }

        $user->save();
        return redirect()->back()->with('success', 'Profile Updated');
    }
}
