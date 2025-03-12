<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogcatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\VehiclecatController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([LocaleMiddleware::class])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');
    Route::get('/vehicle-rental', [PublicController::class, 'vehicle_rental'])->name('vehicle-rental');
    Route::get('/blog', [PublicController::class, 'blog'])->name('blog');

    Route::middleware('guest')->group(function () {
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::resource('/blogs', BlogController::class);
    Route::resource('/vehicles', VehicleController::class);

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('/blogcats', BlogcatController::class);
        Route::resource('/vehiclecats', VehiclecatController::class);
    });
});

Route::get('/locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return redirect()->secure(url()->previous());
    // return back();
})->name('locale');
