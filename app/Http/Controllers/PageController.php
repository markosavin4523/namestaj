<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $data = [];
    public function homePage(){
        $recomendedProducts = Product::take(4)->inRandomOrder()->get();
        $data['recomendedProducts'] = $recomendedProducts;
        return view('pages.home',$data);
    }
    public function profilePage(){
        $user = auth()->user();
        $data['user'] = $user;
        return view('user.my-profile',$data);
    }
}
