<?php

namespace App\Http\Controllers;

use App\TableInfo;
use Illuminate\Http\Request;
use App\Staff;
use Auth;

class TableInfoController extends Controller
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
        
        $table_infos = TableInfo::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.table_infos.index',compact('table_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.table_infos.create');
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
            "name" => "required",
            "capacity" => "required",
        ]);

        $table_infos = new TableInfo;
        $table_infos->name = $request->name;
        $table_infos->capacity = $request->capacity;

        // restaurant_id
        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;
        //print_r($restaurant_id);

        $table_infos->restaurant_id = $restaurant_id;
        $table_infos->save();

        return redirect()->route('table_infos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TableInfo  $tableInfo
     * @return \Illuminate\Http\Response
     */
    public function show(TableInfo $tableInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TableInfo  $tableInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(TableInfo $tableInfo)
    {
        return view('vendor.table_infos.edit',compact('tableInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TableInfo  $tableInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableInfo $tableInfo)
    {
        // validation
        $request->validate([
            "name" => "required",
            "capacity" => "required",
        ]);

       
        $tableInfo->name = $request->name;
        $tableInfo->capacity = $request->capacity;
        $tableInfo->save();

        return redirect()->route('table_infos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TableInfo  $tableInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableInfo $tableInfo)
    {
        $tableInfo->delete();
        return redirect()->route('table_infos.index');
    }
}
