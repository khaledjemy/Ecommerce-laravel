<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//product
//Route::apiResource('products', ProductController::class);

Route::group([
    'controller'=>ProductController::class,
],function(){
Route::get('products', 'index');
Route::post('products', 'store')->middleware(['auth:sanctum', 'can:manage-catalog']);
Route::get('products/{id}', 'show');
Route::post('products/{id}','update')->middleware(['auth:sanctum', 'can:manage-catalog']);
Route::delete('products/{id}', 'destroy')->middleware(['auth:sanctum', 'can:manage-catalog']);
 });

//categories
Route::group([
    'controller'=>CategoryController::class,
],function(){
Route::get('categories', 'index');
Route::post('categories', 'store')->middleware(['auth:sanctum', 'can:manage-catalog']);
Route::get('categories/{id}', 'show');
Route::post('categories/{id}','update')->middleware(['auth:sanctum', 'can:manage-catalog']);
Route::delete('categories/{id}', 'destroy')->middleware(['auth:sanctum', 'can:manage-catalog']);
 });


//register
Route::post('register',[AuthController::class,'register']);

//login
Route::post('login',[AuthController::class,'login']);

//authentication by sanctum
Route::group([
    'middleware'=>'auth:sanctum',
],function(){
  
    Route::get('userprofile',[AuthController::class,'userprofile']);
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('userresource',[AuthController::class,'userResource']);      //get one user by id 
    Route::get('usercollection',[AuthController::class,'userCollection'])->middleware('can:manage-catalog');
});
