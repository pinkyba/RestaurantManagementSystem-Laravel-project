<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
	use SoftDeletes;
    protected $fillable = [
    	'name', 'expensedate', 'price', 'description', 'expense_category_id', 'restaurant_id'
    ];

    public function expense_category()
    {
        return $this->belongsTo('App\ExpenseCategory');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\RestaurantInfo');
    }
}
