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
Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);

Route::get('/login', [LoginController::class,'userLogin'])->name('login');
Route::post('/register/admin', [RegisterController::class,'createAdmin']);

Route::group(['middleware' => 'auth:admin'], function () {
    //Route::view('/admin', 'admin');
	Route::get('/admin', [HomeController::class, 'home']);
	Route::resource('company', CompanyController::class);
	Route::resource('employee', EmployeeController::class);
	
	
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/dashboard', [HomeController::class, 'index']);
	Route::get('/home', [HomeController::class, 'index']);
	
});

Route::get('/',function () {
    return redirect('/login/admin');
});

Route::post('logout', [LoginController::class,'logout']);