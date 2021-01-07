<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

class AdminController extends Controller
{
    public function dashboard($value='')
    {
    	return view('admin.dashboard');
    }

}
