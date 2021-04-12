<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('admin.dashboard');
});
Route::group(['middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::resource('users', UserController::class)->except(['show']);
});

Route::get('home', [HomeController::class, 'home'])->name('home');

require __DIR__.'/auth.php';
