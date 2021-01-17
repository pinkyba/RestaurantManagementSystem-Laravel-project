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

        $orders = Order::where('table_id',$id)
                        ->where('status','served')
                        ->get();

        return view('cashier.cashierdetail',compact('orders','staff'));
    }

    public function cashierdetailprint($id){
        $staff = Staff::where('user_id',Auth::id())->get();
        $orders = Order::where('table_id',$id)
                        ->where('status','served')
                        ->get();

        foreach ($orders as $order) {
            $order->status = 'completed';
            $order->save();
        }
       
        return view('cashier.cashierdetailprint',compact('orders','staff'));
    }
}
