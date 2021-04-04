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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function (){
    //admin template load
    Route::get('login', [App\Http\Controllers\Backend\AdminController::class, 'showAdminLogin'])->name('admin.login');
    Route::get('register', [App\Http\Controllers\Backend\AdminController::class, 'showAdminRegister'])->name('admin.register');
    Route::get('dashboard', [App\Http\Controllers\Backend\AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
    //admin login
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login');
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
    //admin register
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('admin.register');
});

Route::prefix('post')->group(function (){
    Route::resource('', 'App\Http\Controllers\Backend\PostController');
    Route::resource('category', 'App\Http\Controllers\Backend\CategoryController');
    Route::get('category/status-inactive/{id}', 'App\Http\Controllers\Backend\CategoryController@categoryUpdatedInactive');
    Route::get('category/status-active/{id}', 'App\Http\Controllers\Backend\CategoryController@categoryUpdatedActive');
    Route::post('category/delete', 'App\Http\Controllers\Backend\CategoryController@categoryDelete')->name('post.category.delete');
});
