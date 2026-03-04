<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request){
        $aacategory =  $request->category;
        $cat = Category::where('name',$aacategory)->first();
        $products = Product::where('category_id', $cat->id)->get();
        $names  = [];
        foreach($products as $product){
            $names[] = $product->name;
        }
        dd($names);
        return view('welcome');
    }

}
