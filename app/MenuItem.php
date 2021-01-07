<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'photo', 'codeno', 'name', 'price', 'discount', 'description', 'status', 'menu_category_id', 'restaurant_id'
    ];
}
