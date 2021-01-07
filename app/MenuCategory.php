<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuCategory extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'name', 'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\RestaurantInfo');
    }
}
