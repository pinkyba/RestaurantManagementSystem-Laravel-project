<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

use App\RestaurantInfo;
use App\Role;
use App\User;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::orderBy('id','desc')->get();
        return view('admin.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = RestaurantInfo::all();
        $roles = Role::all();
        return view('admin.staff.create',compact('restaurants', 'roles'));
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
            "photo" => "required|mimes:jpg,jpeg,png",
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        //upload
        if($request->file()){
            // fileName => 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // categoryimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('staffimg',$fileName, 'public');

            $path = '/storage/'.$filePath;
            
        }

        //store data into Category model
        $staff = new Staff;
        $users = new User;
        
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->save();

        $staff->photo = $path;
        $staff->phno = $request->phno;
        $staff->NRCno = $request->NRCno;
        $staff->address = $request->address;
        $staff->restaurant_id = $request->restaurant_id;
        
        $userid = User::orderBy('id','desc')->take(1)->get();
        //print_r($userid[0]->id);
        $staff->user_id = $userid[0]->id;
              
        $staff->save();

        // definte role
        $role_id = $request->role_id;
        $role = Role::find($role_id);    


        //assignRole
        $users->assignRole($role->name);

        return redirect()->route('staff.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
