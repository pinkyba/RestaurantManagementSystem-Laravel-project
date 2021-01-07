<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'name', 'restaurant_id'
    ];
}
