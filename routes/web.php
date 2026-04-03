<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\ReviewController;
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
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Middleware\AdminMiddleware;




Route::get('/', [PageController::class, 'homePage'])->name('home.index');
//Admin panel
Route::prefix('admin')->middleware(AdminMiddleware::class)->name("admin.")->group(function () {

    Route::get('/',[AdminPageController::class,"index"])->name('home.index');
    Route::get('/korisnici',[AdminUserController::class,"index"])->name('users.index');
    Route::get('/aktivnosti-korisnika',[AdminPageController::class,"activityIndex"])->name('activity.index');
    Route::patch('/korisnik/uloga/{id}',[AdminUserController::class,"roleUpdate"])->name('role.update');

    Route::resource('/kategorije', AdminCategoryController::class)->names('categories');
    Route::get("/dohvati-podkategorije/{id}", [AdminCategoryController::class, "children"])->name("categories.children");

    Route::get('/gradovi', [AdminCitiesController::class,"index"])->name('cities.index');
    Route::post('/gradovi', [AdminCitiesController::class,"store"])->name('cities.store');
    Route::delete('/gradovi/{id}', [AdminCitiesController::class,"destroy"])->name('cities.destroy');

    Route::get('/kreiraj-proizvod', [AdminProductController::class,"create"])->name('product.create');
    Route::post('/kreiraj-proizvod', [AdminProductController::class,"store"])->name('product.store');

    Route::resource('/proizvodi', AdminProductController::class)->names('products');
    Route::patch('/proizvodi/{id}/ukloni-sa-stanja', [AdminProductController::class,"quantityUpdate"])->name('products.quantityUpdate');

    Route::get('/statusi-porudzbina', [AdminOrderController::class,"statusesIndex"])->name('orderStatuses.index');
    Route::post('/statusi-porudzbina', [AdminOrderController::class,"statusesStore"])->name('orderStatuses.store');

    Route::get('/porudzbine', [AdminOrderController::class,"index"])->name('order.index');
    Route::patch('/porudzbine/{order}', [AdminOrderController::class,"update"])->name('order.update');

    //Kontakt
    Route::get('/poruke', [AdminContactController::class,"index"])->name('contact.index');
    Route::get('/poruke/{c}', [AdminContactController::class,"show"])->name('contact.show');


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
    Route::post("/recenzije",[ReviewController::class,"store"])->name("review.store");

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
Route::post('/kontakt',[ContactController::class,'store'])->name('contact.store');

//Products

Route::get('/sacuvani-proizvodi',[LikeController::class,'index'])->name('like.index');
Route::get("/proizvodi", [ProductController::class,'index'])->name('product.index');
Route::get('/{category}/{subcategory?}',[CategoryController::class,'index'])->name('category.index');
Route::get('/{category}/{subcategory}/{product}',[ProductController::class,'show'])->name('product.show');

Route::get("/recenzije/proizvod/{productSlug}/sve-recenzije/",[ReviewController::class,"index"])->name("review.index");



