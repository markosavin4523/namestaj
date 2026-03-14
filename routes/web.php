<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;




Route::get('/', [PageController::class, 'homePage'])->name('home.index');

//Only guests
Route::middleware('guest')->group(function () {
    //auth views
    Route::view('/prijava','auth.login')->name('login.index');
    Route::view('/registracija','auth.register')->name('register.index');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

//Only authentificated users
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //Account settings
    Route::get('/moj-nalog', [PageController::class, 'profilePage'])->name('my-profile.index');
    Route::get('/moj-nalog/podaci-naloga',[ProfileController::class,'indexRequiredInfo'])->name('profile-required.index');
    Route::get('/moj-nalog/icni-podaci',[ProfileController::class,'indexPersonalInfo'])->name('profile-personal.index');
    Route::put('/moj-nalog/podaci-naloga',[ProfileController::class,'updateRequiredInfo'])->name('profile-required.update');
    Route::put('/moj-nalog/icni-podaci',[ProfileController::class,'updatePersonalInfo'])->name('profile-personal.update');

});

//Contact pages
Route::view('/autor','pages.author')->name('author.index');
Route::view('/kontakt','pages.contact')->name('contact.index');

//
Route::get('/sacuvani-proizvodi',[LikeController::class,'index'])->name('like.index');
Route::get('/korpa',[CartController::class,'index'])->name('cart.index');

Route::get('/{category}/{subcategory?}',[CategoryController::class,'index'])->name('category.index');
