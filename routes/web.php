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
use App\Http\Controllers\ProductController;
// Admin controllers
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCitiesController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;

use App\Http\Middleware\AdminMiddleware;




Route::get('/', [PageController::class, 'homePage'])->name('home.index');
//Admin panel
Route::prefix('admin')->middleware(AdminMiddleware::class)->name("admin.")->group(function () {

    Route::get('/',[AdminPageController::class,"index"])->name('home.index');
    Route::get('/korisnici',[\App\Http\Controllers\Admin\AdminUserController::class,"index"])->name('users.index');
    Route::get('/aktivnosti-korisnika',[AdminPageController::class,"activityIndex"])->name('activity.index');

    Route::get('/kategorije', [AdminCategoryController::class,"index"])->name('category.index');
    Route::get('/gradovi', [AdminCitiesController::class,"index"])->name('cities.index');

    Route::get('/kreiraj-proizvod', [AdminProductController::class,"create"])->name('product.create');
    Route::post('/kreiraj-proizvod', [AdminProductController::class,"store"])->name('product.store');
    Route::get('/proizvodi', [AdminProductController::class,"index"])->name('product.index');

    Route::get('/statusi-porudzbina', [AdminOrderController::class,"statusesIndex"])->name('orderStatuses.index');
    Route::get('/porudzbine', [AdminOrderController::class,"index"])->name('order.index');





});


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
    Route::get('/moj-nalog/podaci-naloga',[ProfileController::class,'editRequiredInfo'])->name('profile-required.edit');
    Route::get('/moj-nalog/licni-podaci',[ProfileController::class,'editPersonalInfo'])->name('profile-personal.edit');
    Route::put('/moj-nalog/podaci-naloga',[ProfileController::class,'updateRequiredInfo'])->name('profile-required.update');
    Route::put('/moj-nalog/icni-podaci',[ProfileController::class,'updatePersonalInfo'])->name('profile-personal.update');
    //Password
    Route::get('/moj-nalog/lozinka',[PasswordController::class,'edit'])->name('profile-password.edit');
    Route::patch('/moj-nalog/lozinka',[PasswordController::class,'update'])->name('profile-password.update');
    //Orders
    Route::get('/moj-nalog/porudzbine',[OrderController::class,'index'])->name('profile-orders.index');
    Route::get('/moj-nalog/istorija-porudzbina',[OrderController::class,'indexHistory'])->name('profile-orders-history.index');
    //Acc delete
    Route::get('/moj-nalog/brisanje-naloga',[ProfileController::class,'indexDeleteAcc'])->name('profile-delete.index');

});
// product like
Route::post('/product/{id}/like', [LikeController::class, 'like'])->name('product.like');

//cart
Route::get('/korpa',[CartController::class,'index'])->name('cart.index');
Route::post('/product/{id}/add-to-cart',[CartController::class,'store'])->name('cart.store');
Route::delete('/product/{id}/remove-from-cart',[CartController::class,'destroy'])->name('cart.destroy');

//orders
Route::get('/korpa/porudzbina',[OrderController::class,'create'])->name('order.create');
Route::post('/korpa/porudzbina',[OrderController::class,'store'])->name('order.store');

//Contact pages
Route::view('/autor','pages.author')->name('author.index');
Route::view('/kontakt','pages.contact')->name('contact.index');

//Products

Route::get('/sacuvani-proizvodi',[LikeController::class,'index'])->name('like.index');
Route::get("/proizvodi", [ProductController::class,'index'])->name('product.index');
Route::get('/{category}/{subcategory?}',[CategoryController::class,'index'])->name('category.index');
Route::get('/{category}/{subcategory}/{product}',[ProductController::class,'show'])->name('product.show');


