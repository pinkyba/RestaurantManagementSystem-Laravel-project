<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Staff;
use App\MenuCategory;
use App\TableInfo;
use App\MenuItem;
use App\Order;
use App\RestaurantInfo;
use Carbon\Carbon;
use App\Expense;

class VendorController extends Controller
{
    public function dashboard($value='')
    {
        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurantid = $staff[0]->restaurant_id;

        $orders = Order::where('status','completed')
                        ->where('orderdate',date('Y-m-d'))
                        ->get();

        $pendingorders = Order::where('orderdate',date('Y-m-d'))
                        ->where('status','served')
                        ->orWhere('status','order')
                        ->get();

        $expenses = Expense::where('restaurant_id',$restaurantid)
        			->whereDate('expensedate',date('Y-m-d'))
        			->get();

    	return view('vendor.vendordashboard',compact('orders','expenses','pendingorders','restaurantid'));
    }
}
