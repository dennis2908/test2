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
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true ");
		header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
		header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
		$response = Http::get('https://zenquotes.io/api/quotes');
    	$jsonData = $response->json();
	    //dd($jsonData);
		$user = Auth::guard('admin')->user()->name;
        return view('quote',compact('user','jsonData'));
    }
	
}
