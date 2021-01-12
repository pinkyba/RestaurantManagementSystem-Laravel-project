<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderdetails extends Model
{
    use SoftDeletes;
	
    protected $fillable = [
            'order_id','menu_item_id', 'qty', 'status'
        ];
}
