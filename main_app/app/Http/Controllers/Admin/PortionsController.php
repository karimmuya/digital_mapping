<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use App\Models\Portion;
use App\Models\User;
use App\Models\Notification;


use Illuminate\Http\Request;



class PortionsController extends Controller
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
    

        return view('admin.portions')->with('users', $users)->with('portions', $portions)->with('notifications', $notifications)->with('lands', $lands);
    }


    public function show($name)
    {
        $land = Land::where('name', $name)->get();
        $portions = Portion::where('land_id', $name)->get();
        return view('admin.editportion')->with('land', $land)->with('portions', $portions);
    }





    public function update(Request $request, $id)
    {




        $portion = Portion::find($id);
        $portion->user_id = $portion->user_id;


        $land = Land::where('name', $portion->land_id)->get();
        foreach($land as $land){
            $pricepersqm = $land->pricepersqm;
            
        }
        $price = $pricepersqm * $request->size;

        if($request->size){
            $portion->size = $request->size;
            $portion->price = $price;
        } else {
            $portion->size = $portion->size ;
            $portion->price = $portion->price ;
        }
        if($request->fill){
            $portion->fill = $request->fill;
        } else {
            $portion->fill = $portion->fill;
        }
        
        if($request->status){
            $portion->status = $request->status;
        } else {
            $portion->status = $portion->status;
        }
        
        if($request->vector){
            $portion->vector = $request->vector;
        } else {
            $portion->vector = $portion->vector;
        }

        if($request->date){
            $portion->due_date = $request->date;
        } else {
            $portion->due_date = $portion->due_date;
        }
        

        $portion->save();
       
      
        return redirect()->back()->with('success', 'Portion Edited');

    }


}
