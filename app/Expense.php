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
}
