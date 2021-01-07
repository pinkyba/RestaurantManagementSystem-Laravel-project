<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function dashboard($value='')
    {
    	return view('vendor.vendordashboard');
    }
}
