<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Staff;
use App\TableInfo;
use App\Order;

class CashierController extends Controller
{
    public function dashboard($value='')
    {
    	$staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $tables = TableInfo::where('restaurant_id',$restaurant_id)->get();

        $orders = Order::all();       

    	return view('cashier.cashierdashboard',compact('tables','orders','staff'));
    }


    public function cashierdetail($id){
        $staff = Staff::where('user_id',Auth::id())->get();
        $order = Order::find($id);

        return view('cashier.cashierdetail',compact('order','staff'));
    }

    public function cashierdetailprint($id){
        $staff = Staff::where('user_id',Auth::id())->get();
        $order = Order::find($id);

        $order->status = 'completed';
        $order->save();
        
        return view('cashier.cashierdetailprint',compact('order','staff'));
    }
}
