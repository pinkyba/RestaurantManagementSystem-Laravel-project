<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Staff;
use Auth;

class BarcounterstaffController extends Controller
{
    public function dashboard($value='')
    {
    	$staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

    	$orders = Order::where('status','order')
                        ->orwhere('status','served')
                        ->get();
    	return view('barcounterstaff.barcounterstaffdashboard',compact('orders','restaurant_id','staff'));
    }

    public function barorderdetail($id){
       
       	$staff = Staff::where('user_id',Auth::id())->get();
        $order = Order::find($id);

        return view('barcounterstaff.barorderdetail',compact('order','staff'));
    }
}
