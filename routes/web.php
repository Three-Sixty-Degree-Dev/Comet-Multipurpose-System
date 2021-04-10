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

//frontend routes
Route::get('blog', [App\Http\Controllers\Frontend\BlogPageController::class, 'showBlogPage'])->name('show.blog.page');
Route::get('blog/single-blog/{slug}', [App\Http\Controllers\Frontend\BlogPageController::class, 'singleBlogPage'])->name('single.blog.page');
Route::get('blog/category/{slug}', [App\Http\Controllers\Frontend\BlogPageController::class, 'blogCategoryWiseSearch'])->name('blog.category.wise.search');
Route::get('blog/tag/{slug}', [App\Http\Controllers\Frontend\BlogPageController::class, 'blogTagWiseSearch'])->name('blog.tag.wise.search');
Route::post('blog/search', [App\Http\Controllers\Frontend\BlogPageController::class, 'blogSearch'])->name('blog.search');
Route::get('blog/user/{id}', [App\Http\Controllers\Frontend\BlogPageController::class, 'singleUserBlog'])->name('single.user.blog');


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
    //post
    Route::resource('', 'App\Http\Controllers\Backend\PostController');
    Route::get('status-inactive/{id}', 'App\Http\Controllers\Backend\PostController@postUpdatedInactive');
    Route::get('status-active/{id}', 'App\Http\Controllers\Backend\PostController@postUpdatedActive');
    Route::post('delete', 'App\Http\Controllers\Backend\PostController@postDelete')->name('post.delete');
    Route::get('single-view/{id}', 'App\Http\Controllers\Backend\PostController@singlePostView')->name('post.show');
    Route::get('trash', 'App\Http\Controllers\Backend\PostController@postTrashShow')->name('post.trash');
    Route::get('trash/update/{id}', 'App\Http\Controllers\Backend\PostController@postTrashUpdate')->name('post.trash.update');
    Route::get('post-edit/{id}', 'App\Http\Controllers\Backend\PostController@postEdit')->name('post.edit');
    Route::put('post-update/{id}', 'App\Http\Controllers\Backend\PostController@postUpdate')->name('post.update');

    //Category
    Route::resource('category', 'App\Http\Controllers\Backend\CategoryController');
    Route::get('category/status-inactive/{id}', 'App\Http\Controllers\Backend\CategoryController@categoryUpdatedInactive');
    Route::get('category/status-active/{id}', 'App\Http\Controllers\Backend\CategoryController@categoryUpdatedActive');
    Route::post('category/delete', 'App\Http\Controllers\Backend\CategoryController@categoryDelete')->name('post.category.delete');
    Route::get('category-trash', 'App\Http\Controllers\Backend\CategoryController@categoryTrash')->name('post.category.trash');
    Route::get('category/trash/update/{id}', 'App\Http\Controllers\Backend\CategoryController@categoryTrashUpdate')->name('post.category.trash.update');

    //Tag
    Route::resource('tag', 'App\Http\Controllers\Backend\TagController');
    Route::get('tag/status-inactive/{id}', 'App\Http\Controllers\Backend\TagController@tagUpdatedInactive');
    Route::get('tag/status-active/{id}', 'App\Http\Controllers\Backend\TagController@tagUpdatedActive');
    Route::post('tag/delete', 'App\Http\Controllers\Backend\TagController@tagDelete')->name('post.tag.delete');
    Route::get('tag-trash', 'App\Http\Controllers\Backend\TagController@tagTrash')->name('post.tag.trash');
    Route::get('tag/trash/update/{id}', 'App\Http\Controllers\Backend\TagController@tagTrashUpdate')->name('post.tag.trash.update');
});
