<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{	
    
    public function index()
    {
		$user = Auth::user()->name;
        return view('home',compact('user'));
    }
	
	public function home()
    {
		$user = Auth::guard('admin')->user()->name;
        return view('admin',compact('user'));
    }
	
}
