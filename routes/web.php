<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Category;

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
    return view('auth.login');
});

Auth::routes();

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register"); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//user
Route::resource('users', UserController::class);

// category book
Route::get('/category/trash', [Category::class, 'trash'])->name('trash');
Route::get("category/detailTrash/{id}", [Category::class, "detailTrash"])->name('detailTrash');
Route::delete('category/removeTrash/{id}', [Category::class, "removeTrash"])->name('removeTrash');
Route::get('category/restoreTrash/{id}', [Category::class, "restoreTrash"])->name('restoreTrash');

Route::resource('category', Category::class);
