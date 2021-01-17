<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;
use App\Staff;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('waiter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->codeno = uniqid();
        $order->orderdate = date('Y-m-d');
        $order->total = $request->total;

        //waiter_id
        $staff = Staff::where('user_id',Auth::id())->get();
        $waiter_id = $staff[0]->id;

        $order->waiter_id = $waiter_id;
        $order->table_id = $request->tableno;
        
        $order->save();

        $cartArray = json_decode($request->cart);
        foreach ($cartArray as $row) {

            // attach with many to many pivot relationship between Order and Item
            // store order_id, item_id, qty in orderdetails table
            $order->menu_items()->attach($row->id,["qty"=>$row->qty]);

        }
        
        return 'Order Successful!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function confirm($orderid,$menuid,$status)
    {
        $order = Order::find($orderid);
        
        //update status in orderdetails(pivot table)
        $order->menu_items()
            ->newPivotStatement()
            ->where('menu_item_id', '=', $menuid)
            ->update(array('status' => 'served'));
        
        // update status of order table to 'served' if status of all orderdetails by each orderid is "served"
        $state = 1;
        foreach($order->menu_items as $menu_item) {

            // print_r($menu_item->pivot->status);
            
            if($menu_item->pivot->status == 'order'){
                $state = 0;
                break;
            }
        }
        //print_r($state);
        if($state == 1){
            $order->status = 'served';
            $order->save();
            alert()->message('✨✨Order Completed!🎉🎉');
        }
        
        if($status == 'bar'){
            return redirect()->route('barorderdetail',$orderid);
        }
        else{
            return redirect()->route('cheforderdetail',$orderid);
        }
        
    }
}
