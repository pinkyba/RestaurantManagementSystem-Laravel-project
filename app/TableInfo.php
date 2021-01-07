<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableInfo extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'name', 'capacity', 'restaurant_id'
    ];
}
