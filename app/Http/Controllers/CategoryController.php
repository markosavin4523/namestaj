<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $data = [];
    public function index(string $categorySlug ,string $subcategorySlug = null)
    {
        $category = Category::where('slug', $categorySlug)
            ->with('children')
            ->firstOrFail();

        $subcategories = $category->children;
        $data['subcategories'] = $subcategories;
        $data['category'] = $category;

        if (!$subcategorySlug) {
            return view('products.category', $data);
        }

        $subcategory = $category->children()
            ->where('slug', $subcategorySlug)
            ->firstOrFail();

        $products = $subcategory->products()->paginate(12);
        $data['products'] = $products;
        $data['subcategory'] = $subcategory;
        return view('products.products', $data);

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
    public function show(string $id)
    {
        //
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
