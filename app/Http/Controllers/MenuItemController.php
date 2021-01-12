<?php

namespace App\Http\Controllers;

use App\MenuItem;
use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\MenuCategory;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $menu_items = MenuItem::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.menu_items.index',compact('menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $menu_categories = MenuCategory::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.menu_items.create',compact('menu_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        // validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],           
            'price' => ['required'],
            'description' => ['sometimes'],
            "photo" => "required|mimes:jpg,jpeg,png",
        ]);

        //upload
        if($request->file()){
            // fileName => 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // categoryimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('menuitemsimg',$fileName, 'public');

            $path = '/storage/'.$filePath;           
        }

        $menu_items = new MenuItem;
        
        $menu_items->name = $request->name;
        $menu_items->codeno = uniqid();
        $menu_items->photo = $path;
        $menu_items->price = $request->price;
        $menu_items->discount = $request->discount;
        $menu_items->menu_category_id = $request->menu_category_id;
        $menu_items->description = $request->description;

        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $menu_items->restaurant_id = $restaurant_id;
        $menu_items->save();

        return redirect()->route('menu_items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuItem)
    {
        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $menu_categories = MenuCategory::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.menu_items.edit',compact('menuItem','menu_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        //dd($request);
        // validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'codeno' => ['required'],
            'price' => ['required'],
            'description' => ['sometimes'],
            
        ]);

        //upload
        if($request->file()){
            // fileName => 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // categoryimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('menuitemsimg',$fileName, 'public');

            $path = '/storage/'.$filePath;
            
        }else{
            $path = $request->oldphoto;
        }
        
        $menuItem->name = $request->name;
        $menuItem->codeno = $request->codeno;
        $menuItem->photo = $path;
        $menuItem->price = $request->price;
        $menuItem->discount = $request->discount;
        $menuItem->menu_category_id = $request->menu_category_id;
        $menuItem->description = $request->description;
        $menuItem->save();

        return redirect()->route('menu_items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('menu_items.index');
    }
}
