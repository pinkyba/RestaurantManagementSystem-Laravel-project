<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuCategory extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'name', 'status', 'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\RestaurantInfo');
    }

    public function menu_items()
    {
        return $this->hasMany('App\MenuItem');
    }
}
