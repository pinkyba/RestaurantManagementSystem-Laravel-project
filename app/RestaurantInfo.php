<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantInfo extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'photo', 'name', 'address', 'phno', 'email', 'description'
    ];

    public function staff()
    {
        return $this->hasMany('App\Staff');
    }

    public function menucategories()
    {
        return $this->hasMany('App\MenuCategory');
    }
}
