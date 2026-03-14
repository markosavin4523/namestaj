<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\OrderController;




Route::get('/', [PageController::class, 'homePage'])->name('home.index');

//Only guests
Route::middleware('guest')->group(function () {
    //auth views
    Route::view('/prijava','auth.login')->name('login');
    Route::view('/registracija','auth.register')->name('register');
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

//Only authentificated users
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //Account settings
    Route::get('/moj-nalog', [PageController::class, 'profilePage'])->name('my-profile.index');
    Route::get('/moj-nalog/podaci-naloga',[ProfileController::class,'indexRequiredInfo'])->name('profile-required.index');
    Route::get('/moj-nalog/licni-podaci',[ProfileController::class,'indexPersonalInfo'])->name('profile-personal.index');
    Route::put('/moj-nalog/podaci-naloga',[ProfileController::class,'updateRequiredInfo'])->name('profile-required.update');
    Route::put('/moj-nalog/icni-podaci',[ProfileController::class,'updatePersonalInfo'])->name('profile-personal.update');
    //Password
    Route::get('/moj-nalog/lozinka',[PasswordController::class,'index'])->name('profile-password.index');
    Route::put('/moj-nalog/lozinka',[PasswordController::class,'update'])->name('profile-password.update');
    //Orders
    Route::get('/moj-nalog/porudzbine',[OrderController::class,'index'])->name('profile-orders.index');
    Route::get('/moj-nalog/istorija-porudzbina',[OrderController::class,'indexHistory'])->name('profile-orders-history.index');
    //Acc delete
    Route::get('/moj-nalog/brisanje-naloga',[ProfileController::class,'indexDeleteAcc'])->name('profile-delete.index');

});

//Contact pages
Route::view('/autor','pages.author')->name('author.index');
Route::view('/kontakt','pages.contact')->name('contact.index');

//
Route::get('/sacuvani-proizvodi',[LikeController::class,'index'])->name('like.index');
Route::get('/korpa',[CartController::class,'index'])->name('cart.index');

Route::get('/{category}/{subcategory?}',[CategoryController::class,'index'])->name('category.index');
