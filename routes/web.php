<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
    });

Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');





Route::get('/view_category',[AdminController::class,'view_category']);
Route::post('/add_category',[AdminController::class,'add_category']);
Route::get('/delete_category/{id}',[AdminController::class,'destroy']);
Route::get('/order',[AdminController::class,'order']);
Route::get('/delivered/{id}',[AdminController::class,'delivered']);
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
Route::get('/send_email/{id}',[AdminController::class,'send_email']);
Route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);
Route::get('/search',[AdminController::class,'search']);
Route::get('/show_order',[AdminController::class,'show_order']);
Route::get('/cancel_order/{id}',[AdminController::class,'cancel_order']);
#######################################################################

Route::get('/view_product',[ProductController::class,'view_product']);
Route::post('/add_product',[ProductController::class,'add_product']);
Route::get('/show_product',[ProductController::class,'show_product']);
Route::get('/delete_product/{id}',[ProductController::class,'destroy']);
Route::get('/update_product/{id}',[ProductController::class,'update_product']);
Route::post('/update_product_confirm/{id}',[ProductController::class,'update']);
Route::get('/product_details/{id}',[ProductController::class,'product_details']);
Route::post('/add_to_cart/{id}',[ProductController::class,'add_to_cart']);
Route::get('/show_cart',[CartController::class,'show_cart']);
Route::get('/remove_product/{id}',[CartController::class,'remove_product']);
Route::get('/cash_order',[CartController::class,'cash_order']);
Route::get('/stripe/{totalprice}',[CartController::class,'stripe']);

Route::post('/stripe/{totalprice}',[CartController::class,'stripePost'])->name('stripe.post');

#######################################################################
