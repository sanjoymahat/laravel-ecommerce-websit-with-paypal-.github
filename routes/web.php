<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/about',[ProjectController::class,'about'])->name('about');
Route::get('/review',[ProjectController::class,'review'])->name('review');
Route::get('/insert_product', [ProjectController::class, 'create']);
Route::post('/insert_product', [ProjectController::class, 'store']);
Route::get('/single_product/{id}', [ProjectController::class, 'single_product'])->name('single_product');//here passing id in index.blade.php
Route::get('/single_product', function(){ return redirect('/');});//when user without passing id this page redirect <index class="blade php"></index>
Route::get('/products', [ProjectController::class, 'products'])->name('products');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/add_to_cart', function(){ return redirect('/');} );
Route::post('/remove_form_cart', [CartController::class, 'remove_form_cart'])->name('remove_form_cart');
Route::get('/remove_form_cart',function(){return redirect('/');});

Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');


Route::post('/place_order',[CartController::class,'place_order'])->name('place_order');

Route::get('/payment',[PaymentController::class,'payment'])->name('payment');

Route::get('/verify_payment/{tansaction_id}',[PaymentController::class,'verify_payment'])->name('verify_payment');
Route::get('/complete_payment',[PaymentController::class,'complete_payment'])->name('complete_payment');

