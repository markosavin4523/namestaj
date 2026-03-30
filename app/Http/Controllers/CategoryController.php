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
    public function index(Request $request, string $categorySlug ,string $subcategorySlug = null)
    {
        //Prikaz podkategorija iz kategorije
        $category = Category::where('slug', $categorySlug)
            ->with('children')
            ->firstOrFail();

        $subcategories = $category->children;
        $data['subcategories'] = $subcategories;
        $data['category'] = $category;

        if (!$subcategorySlug) {
            return view('products.category', $data);
        }
        //Prikaz proizvoda iz kategorije
        $subcategory = $category->children()
            ->where('slug', $subcategorySlug)
            ->firstOrFail();

        $query = $subcategory->products()->with(['image','dimension']);
        //Filtriranje proizvoda
        $sort = $request->sort;
        $price = $request->price;
        $minWidth = $request->min_width;
        $maxWidth = $request->max_width;
        $minHeight = $request->min_height;
        $maxHeight = $request->max_height;
        $minDepth = $request->min_depth;
        $maxDepth = $request->max_depth;
        if ($request->filled("sort")){
            if($sort == "asc") $query->orderBy('price');
            if($sort == "desc") $query->orderBy('price','desc');
        }
        if ($request->price > 0) {
            $query->where('price', '<=', $price);
        }

        if ($request->filled('min_width')) {
            $query->whereHas('dimension', function ($query) use ($minWidth) {
                $query->where('width', '>=', $minWidth);
            });
        }

        if ($request->filled('max_width')) {
            $query->whereHas('dimension', function ($query) use ($maxWidth) {
                $query->where('width', '<=', $maxWidth);
            });
        }

        if ($request->filled('min_height')) {
            $query->whereHas('dimension', function ($query) use ($minHeight) {
                $query->where('height', '>=', $minHeight);
            });
        }

        if ($request->filled('max_height')) {
            $query->whereHas('dimension', function ($query) use ($maxHeight) {
                $query->where('height', '<=', $maxHeight);
            });
        }

        if ($request->filled('min_depth')) {
            $query->whereHas('dimension', function ($query) use ($minDepth) {
                $query->where('depth', '>=', $minDepth);
            });
        }

        if ($request->filled('max_depth')) {
            $query->whereHas('dimension', function ($query) use ($maxDepth) {
                $query->where('depth', '<=', $maxDepth);
            });
        }

        $products = $query->paginate(12);
        $data['products'] = $products;
        $data['subcategory'] = $subcategory;
        $data['request'] = $request;
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
