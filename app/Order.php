<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
            'codeno','orderdate', 'total', 'status', 'waiter_id', 'table_id', 'restaurant_id'
        ];
}
