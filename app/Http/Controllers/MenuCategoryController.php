<?php

namespace App\Http\Controllers;

use App\MenuCategory;
use Illuminate\Http\Request;
use Auth;
use App\Staff;

class MenuCategoryController extends Controller
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

        $menu_categories = MenuCategory::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.menu_categories.index',compact('menu_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.menu_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required|max:35'",
        ]);

        $menu_categories = new MenuCategory;
        $menu_categories->name = $request->name;
        $menu_categories->status = $request->status;

        // restaurant_id
        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;
        //print_r($restaurant_id);

        $menu_categories->restaurant_id = $restaurant_id;
        $menu_categories->save();

        return redirect()->route('menu_categories.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MenuCategory $menuCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuCategory $menuCategory)
    {
        $menu_categories = MenuCategory::all();
        return view('vendor.menu_categories.edit',compact('menuCategory','menu_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        // validation
        $request->validate([
            "name" => "required|max:35'",
        ]);

       
        $menuCategory->name = $request->name;
        $menuCategory->save();

        return redirect()->route('menu_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuCategory $menuCategory)
    {
        $menuCategory->delete();
        return redirect()->route('menu_categories.index');
    }
}
