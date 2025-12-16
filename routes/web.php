<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PublicController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class,"index"]);



Route::group([
'controller'=>PublicController::class,
],function(){
   Route::get('index','index')->name('index');
   Route::get('about','about')->name('about');
   Route::get('contact','contact')->name('contact');
   Route::get('products','products')->name('products');
   Route::get('single-product/{id}','show')->name('singleproduct');
});

//admin
Route::group([
    'controller' => CategoryController::class,
    'prefix' => 'category',
    'as' => 'category.',
    'middleware'=>['verified'],
], function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('index', 'index')->name('index');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    Route::get('delete/{id}', 'destroy')->name('destroy');
    
});

Route::group([
    'controller' => UserController::class,
    'prefix' => 'user',
    'as' => 'user.',
    'middleware'=>['verified'],
], function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('index', 'index')->name('index');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    
    
});

Route::group([
    'controller' => ProductController::class,
    'prefix' => 'product',
    'as' => 'product.',
    'middleware'=>['verified'],
], function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('index', 'index')->name('index');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    Route::get('delete/{id}', 'destroy')->name('destroy');
    
});




//contact

Route::post('contact',[ContactController::class,'store'])->name('store');

Route::post('subscribe',[ContactController::class,'send'])->name('send');

//cart
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
