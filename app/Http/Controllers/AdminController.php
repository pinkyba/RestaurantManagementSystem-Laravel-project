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

class AdminController extends Controller
{
    public function dashboard($value='')
    {
        $restaurants = RestaurantInfo::all();

        $orders = Order::where('status','completed')
                        ->whereDate('orderdate',date('Y-m-d'))
                        ->get();

        $pendingorders = Order::whereDate('orderdate',date('Y-m-d'))
                        ->where('status','served')
                        ->orWhere('status','order')
                        ->get();
        
        $expenses = Expense::whereDate('expensedate',date('Y-m-d'))->get();

        $restaurantid = 1;

    	return view('admin.dashboard',compact('restaurants','orders','restaurantid','expenses','pendingorders'));
    }

    public function admindashboardFilter(Request $request)
    {
        $restaurants = RestaurantInfo::all();
        $restaurantid = $request->restaurant_id;

        $orders = Order::where('status','completed')
                        ->whereDate('orderdate',date('Y-m-d'))
                        ->get(); 

        $pendingorders = Order::whereDate('orderdate',date('Y-m-d'))
                        ->where('status','served')
                        ->orWhere('status','order')
                        ->get();

        $expenses = Expense::all();     

        return view('admin.dashboard',compact('restaurants','orders','restaurantid','expenses','pendingorders'));
    }

    // order report
    public function adminorder($value='')
    {
    	$restaurants = RestaurantInfo::all();
    	$orders = Order::orderBy('id','desc')->where('status','completed')->get();

        $restaurantid = 0;

    	return view('admin.order.index',compact('restaurants','orders','restaurantid'));
    }

    // order search form
    public function adminwaiter(Request $request)
    { 
        $restaurant_id = $request->restaurant_id;
         
        $waiters = Staff::where('restaurant_id',$restaurant_id)
        					->with('user')->get();

        return response()->json([
            'waiters' => $waiters
        ]);
    }

    // order search result
    public function adminOrderFilter(Request $request)
    { 
    	//dd($request);
    	$restaurants = RestaurantInfo::all();
   	
        $restaurantid = $request->restaurant_id;
        $waiter_id = $request->waiter_id;
        $date = $request->date;

        
    	if($date == 'today'){
    		$orders = Order::whereDate('orderdate', date('Y-m-d'))
                            ->where('status','completed')
                            ->where('waiter_id',$waiter_id)
                            ->get();
    	}
    	else{
    		$orders = Order::whereMonth('orderdate', Carbon::now()->month)
                            ->where('status','completed')
                            ->where('waiter_id',$waiter_id)
                            ->get();
    	}        	

        return view('admin.order.index',compact('restaurants','orders','restaurantid'));

    }


    // current sale report
    public function admincurrentSale($value='')
    {
        $restaurants = RestaurantInfo::all();

        $orders = Order::where('status','completed')
                        ->whereDate('orderdate',date('Y-m-d'))
                        ->get();

        $restaurantid = 2;

        return view('admin.report.currentSale',compact('restaurants','orders','restaurantid'));
    }

    public function admincurrentSaleFilter(Request $request)
    { 
        //dd($request);
        $restaurants = RestaurantInfo::all();
    
        $restaurantid = $request->restaurant_id;

        $orders = Order::where('status','completed')
                        ->where('orderdate',date('Y-m-d'))
                        ->get();

        return view('admin.report.currentSale',compact('restaurants','orders','restaurantid'));
    }


    // month sale report
    public function adminmonthSale($value='')
    {
        $restaurants = RestaurantInfo::all();

        $orders = Order::whereMonth('orderdate', Carbon::now()->month)
                            ->where('status','completed')
                            ->get();
        

        $month = Carbon::now()->monthName;

        $restaurantid = 2;

        return view('admin.report.monthSale',compact('restaurants','orders','restaurantid','month'));
    }

    public function adminmonthSaleFilter(Request $request)
    { 
        //dd($request);
        $restaurants = RestaurantInfo::all();
    
        $restaurantid = $request->restaurant_id;
        $mS = $request->month;

        $month = Carbon::now()->monthName;
        // print_r($month);
        // print_r(Carbon::now()->year);

        $orders = Order::whereMonth('orderdate', $mS)
                        ->whereYear('orderdate', Carbon::now()->year)
                        ->where('status','completed')
                        ->get();
        
        return view('admin.report.monthSale',compact('restaurants','orders','restaurantid','month'));
    }


    // year sale report
    public function adminyearSale($value='')
    {
        $restaurants = RestaurantInfo::all();

        $orders = Order::whereYear('orderdate', Carbon::now()->year)
                            ->where('status','completed')
                            ->get();
        

        $year = Carbon::now()->year;

        $restaurantid = 2;

        return view('admin.report.yearSale',compact('restaurants','orders','restaurantid','year'));
    }

    public function adminyearSaleFilter(Request $request)
    { 
        //dd($request);
        $restaurants = RestaurantInfo::all();
    
        $restaurantid = $request->restaurant_id;
        $year = $request->year;
        // print_r($month);
        // print_r(Carbon::now()->year);

        $orders = Order::whereYear('orderdate', $year)
                        ->where('status','completed')
                        ->get();
        
        return view('admin.report.yearSale',compact('restaurants','orders','restaurantid','year'));
    }


    // daily sale report
    public function admindailySale($value='')
    {
        $restaurants = RestaurantInfo::all();

        $orders = Order::whereDate('orderdate', date('Y-m-d'))
                            ->where('status','completed')
                            ->get();
        

        $date = date('Y-m-d');

        $restaurantid = 2;

        return view('admin.report.dailySale',compact('restaurants','orders','restaurantid','date'));
    }

    public function admindailySaleFilter(Request $request)
    { 
        //dd($request);
        $restaurants = RestaurantInfo::all();
    
        $restaurantid = $request->restaurant_id;
        $date = $request->date;
        //print_r($date);

        $orders = Order::whereDate('orderdate', $date)
                        ->where('status','completed')
                        ->get();
        
        return view('admin.report.dailySale',compact('restaurants','orders','restaurantid','date'));
    }
}
