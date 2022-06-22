<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post(
    '/checkout', 
    [HomeController::class, 'checkout']
)->name('checkout');

Route::post(
    '/resume', 
    [HomeController::class, 'resume']
)->name('resume');

Route::get(
    '/admin/dashboard', 
    [AdminController::class, 'dashboard']
)->name('admin.dashboard');

Route::post(
    '/order/create', 
    [OrderController::class, 'create']
)->name('order.create');

Route::post(
    '/order/pay', 
    [OrderController::class, 'pay']
)->name('order.pay');

Route::get(
    '/order/track',
    [OrderController::class, 'track']
)->name('order.track');

Route::post(
    '/order/search',
    [OrderController::class, 'search']
)->name('order.search');

Route::get(
    '/order/index/{hash?}',
    [OrderController::class, 'index']
)->name('order.index');

Route::get(
    '/order/detail/{hash}',
    [OrderController::class, 'detail']
)->name('order.detail');
