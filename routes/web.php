<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoreSettingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
Route::middleware(['auth', 'verified', 'can:manage-catalog'])->group(function () {
    Route::get('/admin/store-settings', [StoreSettingController::class, 'edit'])->name('admin.store-settings.edit');
    Route::put('/admin/store-settings', [StoreSettingController::class, 'update'])->name('admin.store-settings.update');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::get('/admin/inbox', [InboxController::class, 'index'])->name('admin.inbox.index');
});
Route::group([
    'controller' => CategoryController::class,
    'prefix' => 'category',
    'as' => 'category.',
    'middleware'=>['auth', 'verified', 'can:manage-catalog'],
], function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('index', 'index')->name('index');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    Route::delete('delete/{id}', 'destroy')->name('destroy');
    
});

Route::group([
    'controller' => UserController::class,
    'prefix' => 'user',
    'as' => 'user.',
    'middleware'=>['auth', 'verified', 'can:manage-catalog'],
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
    'middleware'=>['auth', 'verified', 'can:manage-catalog'],
], function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('index', 'index')->name('index');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    Route::delete('delete/{id}', 'destroy')->name('destroy');
    
});




//contact

Route::post('contact',[ContactController::class,'store'])->middleware('throttle:5,1')->name('store');

Route::post('subscribe',[ContactController::class,'send'])->middleware('throttle:5,1')->name('send');

//cart
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/checkout', [CheckoutController::class, 'create'])->middleware('verified')->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('verified')->name('checkout.store');
    Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('orders.show');
});


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
