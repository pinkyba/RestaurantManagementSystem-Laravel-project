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

    public function restaurant()
    {
        return $this->belongsTo('App\RestaurantInfo');
    }

    public function orders($value='')
    {
        return $this->hasMany('App\Order');
    }
}
