<?php

namespace App\Http\Controllers;

use App\RestaurantInfo;
use Illuminate\Http\Request;

class RestaurantInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = RestaurantInfo::all();
        return view('admin.restaurantInfos.index',compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.restaurantInfos.create');
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
            "name" => "required|max:35'",
            "photo" => "required|mimes:jpg,jpeg,png",

        ]);

        //upload
        if($request->file()){
            // fileName => 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // categoryimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('restaurantimg',$fileName, 'public');

            $path = '/storage/'.$filePath;
            
        }

        //store data into Category model
        $restaurants = new RestaurantInfo;
        $restaurants->name = $request->name;
        $restaurants->photo = $path;
        $restaurants->phno = $request->phno;
        $restaurants->email = $request->email;
        $restaurants->address = $request->address;
        $restaurants->description = $request->description;
        $restaurants->save();

        // return
        return redirect()->route('restaurantInfos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RestaurantInfo  $restaurantInfo
     * @return \Illuminate\Http\Response
     */
    public function show(RestaurantInfo $restaurantInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RestaurantInfo  $restaurantInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(RestaurantInfo $restaurantInfo)
    {
        return view('admin.restaurantInfos.edit',compact('restaurantInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RestaurantInfo  $restaurantInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RestaurantInfo $restaurantInfo)
    {
        
        //upload
        if($request->file()){
            // fileName => 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // categoryimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('restaurantimg',$fileName, 'public');

            $path = '/storage/'.$filePath;
            
        }else{
            $path = $request->oldphoto;
        }

        $restaurantInfo->name = $request->name;
        $restaurantInfo->photo = $path;
        $restaurantInfo->phno = $request->phno;
        $restaurantInfo->email = $request->email;
        $restaurantInfo->address = $request->address;
        $restaurantInfo->description = $request->description;
        $restaurantInfo->save();

        // return
        return redirect()->route('restaurantInfos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RestaurantInfo  $restaurantInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(RestaurantInfo $restaurantInfo)
    {
        $restaurantInfo->delete();
        return redirect()->route('restaurantInfos.index');
    }
}
