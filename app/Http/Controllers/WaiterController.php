<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Staff;
use App\MenuCategory;
use App\TableInfo;
use App\MenuItem;
use App\Order;

class WaiterController extends Controller
{
    public function dashboard($value='')
    {
    	$staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $tables = TableInfo::where('restaurant_id',$restaurant_id)->get();

        $orders = Order::all();       

    	return view('waiter.waiterdashboard',compact('tables','orders','staff'));
    }


    public function tableno($id,$menuCategoryid){

    	$staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $tables = TableInfo::where('restaurant_id',$restaurant_id)->get();

        if($menuCategoryid == 0){
            $menu_items = MenuItem::where('restaurant_id',$restaurant_id)->get();
        }
        else{
            $menu_items = MenuItem::where('restaurant_id',$restaurant_id)
                                ->where('menu_category_id',$menuCategoryid)
                                ->get();
        }
       

        $menu_categories = MenuCategory::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();

    	return view('waiter.tableno',compact('id','menu_categories','tables','menu_items','staff'));
    }


    public function tableorderdisplay($id){
        print_r($id);

        $staff = Staff::where('user_id',Auth::id())->get();
        $orders = Order::where('table_id',$id)->get();

        return view('waiter.tableorderdisplay',compact('orders','staff'));
    }
}
