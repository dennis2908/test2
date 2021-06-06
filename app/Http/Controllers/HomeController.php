<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
	
	public function quote()
    {
		//$response = Http::get('https://zenquotes.io/api/quotes');
    	//$jsonData = $response->json();
		//dd($jsonData);
		$user = Auth::guard('admin')->user()->name;
        return view('quote',compact('user'));
    }
	
}
