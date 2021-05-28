<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

//Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/blogger', [LoginController::class,'showBloggerLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/blogger', [RegisterController::class,'showBloggerRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/blogger', [LoginController::class,'bloggerLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register/blogger', [RegisterController::class,'createBlogger']);

Route::group(['middleware' => 'auth:blogger'], function () {
    Route::view('/blogger', 'blogger');
});

Route::group(['middleware' => 'auth:admin'], function () {
    
    Route::view('/admin', 'admin');
	
	Route::resource('company', CompanyController::class);
	Route::resource('employee', EmployeeController::class);
	
	
});

Route::get('/',function () {
    return redirect('/login/admin');
});

Route::get('/dashboard',function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'home']);

Route::get('logout', [LoginController::class,'logout']);