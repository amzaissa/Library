<?php

use App\Http\Controllers\AdminApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
   Route::resource('admin/role',ApiController::class);
    
    
    // Route::resource('dashboard',AdminController::class);
    Route::get('admin/index',[AdminApiController::class,'index']);
    Route::post('admin/addbook',[AdminApiController::class,'store']);
    Route::delete('admin/delete/{id}',[AdminApiController::class,'delete']);
    Route::post('admin/updatebook/{id}',[AdminApiController::class,'update']);
    Route::post('admin/addCategory',[AdminApiController::class,'addCategory']);
    Route::post('admin/updateCategory/{id}',[AdminApiController::class,'updateCategory']);
    Route::delete('admin/deleteCategory/{id}',[AdminApiController::class,'deleteCategory']);
    
    
    Route::post('/admin/logout', [AuthController::class, 'logout']);
});
Route::middleware(['auth:sanctum','role:user'])->group(function () 
    {

        Route::post('/favorite/{book}', [FavoriteController::class, 'addToFavorites']);
        Route::post('/rateBook/{book}', [FavoriteController::class, 'rateBook']);
        Route::get('/filterByCategory', [FavoriteController::class, 'filterByCategory']);
        Route::get('/index', [FavoriteController::class, 'index']);
        Route::get('/show/{book}', [FavoriteController::class, 'show']);
        Route::post('/logout', [AuthController::class, 'logout']);

   
    });
    Route::post('/login', [AuthController::class, 'login']);


Route::get('books',[VisitorController::class,'filterByCategory']);
Route::get('books',[VisitorController::class,'browse']);
Route::get('books/{id}',[VisitorController::class,'show']);

