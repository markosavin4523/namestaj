<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $data = [];
    public function index(Request $request)
    {
        $term = $request->term;
        if(!$term){
            return back()->with("error","Unesite pojam za pretragu");
        }
        $products = Product::where('name', 'like', '%' . $term . '%')
            ->where("quantity", ">", 0)
            ->orWhereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->paginate(12);
        $this->data['products'] = $products;
        $this->data['term'] = $term;
        return view('products.search-result', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $parentCategorySlug, string $categorySlug, string $productSlug)
    {
        try {
            $product = Product::where('slug', $productSlug)->firstOrFail();
            if ($product->category->slug != $categorySlug || $product->category->parent->slug != $parentCategorySlug) {
                abort(404);
            }
            $data['product'] = $product;
            return view('products.product', $data);
        }
        catch (\Exception $e) {
    abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
