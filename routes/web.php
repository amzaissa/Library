<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('dashboard',AdminController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('books', BooksController::class);
    Route::get('dashboard/rate/{is}',[AdminController::class,'rate'])->name('rate');
    Route::post('dashboard/rate/{is}',[AdminController::class,'addRate'])->name('addRate');

    // Route::post('rate/{id}',[HomeController::class,'rate'])->name('addRate');
});

Route::get('dashboard/{id}',[HomeController::class,'rate']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

