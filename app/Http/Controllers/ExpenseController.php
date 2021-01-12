<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use App\Staff;
use Auth;
use App\ExpenseCategory;

class ExpenseController extends Controller
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

        $expenses = Expense::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.expenses.index',compact('expenses'));
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

        $expense_categories = ExpenseCategory::where('restaurant_id',$restaurant_id)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('vendor.expenses.create',compact('expense_categories'));
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
            "date" => "sometimes",
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'description' => ['sometimes'],
        ]);

        //store data into Category model
        $expenses = new Expense;
        
        $expenses->name = $request->name;
        $expenses->expensedate = $request->date;
        $expenses->price = $request->price;
        $expenses->expense_category_id = $request->expense_category_id;
        $expenses->description = $request->description;

        $staff = Staff::where('user_id',Auth::id())->get();
        $restaurant_id = $staff[0]->restaurant_id;

        $expenses->restaurant_id = $restaurant_id;
        $expenses->save();

        return redirect()->route('expenses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $expense_categories = ExpenseCategory::all();
        return view('vendor.expenses.edit',compact('expense','expense_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        // validation
        $request->validate([
            "date" => "sometimes",
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'description' => ['sometimes'],
        ]);

        
        $expense->name = $request->name;
        $expense->expensedate = $request->date;
        $expense->price = $request->price;
        $expense->expense_category_id = $request->expense_category_id;
        $expense->description = $request->description;
        $expense->save();

        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index');
    }
}
