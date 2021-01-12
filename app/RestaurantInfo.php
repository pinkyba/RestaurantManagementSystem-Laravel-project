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

    public function expensecategories()
    {
        return $this->hasMany('App\ExpenseCategory');
    }

    public function tableinfos()
    {
        return $this->hasMany('App\TableInfo');
    }

    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    public function menu_items()
    {
        return $this->hasMany('App\MenuItem');
    }
}
