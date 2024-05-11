<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return (new DashboardController)->admin();
            } else {
                return (new DashboardController)->admin();
            }
        } else {
            return view('auth.login');
        }
    })->name('home');

    Route::get('/edit-profile', function () {
        return view('profile.index');
    })->name('profile.edit');
    Route::put('/edit-profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('can:admin')->group(function () {
        Route::resource('setting-users', App\Http\Controllers\SettingUserController::class);
    });

    Route::middleware('can:user')->group(function () {
    });
});
