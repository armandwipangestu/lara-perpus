<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User2Controller;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/signin');
});

Route::get('/signin', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/signin', [AuthController::class, 'authenticate']);
Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth');
Route::get('/signup', [AuthController::class, 'signup'])->middleware('guest');
Route::post('/signup', [AuthController::class, 'storeSignup']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::put('/user', [UserController::class, 'update'])->middleware('auth');
Route::get('/user/change-password', [UserController::class, 'changePassword'])->name('test')->middleware('auth');
Route::put('/user/change-password', [UserController::class, 'updatePassword'])->middleware('auth');

Route::get('/admin', function () {
    return view('dashboard.index', [
        'title' => 'Admin'
    ]);
});
Route::get('/operator', function () {
    return view('dashboard.index', [
        'title' => 'Operator'
    ]);
});
Route::get('/member', function () {
    return view('dashboard.index', [
        'title' => 'Member'
    ]);
});
