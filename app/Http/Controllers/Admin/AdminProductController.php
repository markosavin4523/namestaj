<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Dimension;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(12);
        return view('admin.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainCategories = Category::where("parent_id", null)->with("children")->get();
       return view('admin.create-product',compact('mainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try{
            DB::beginTransaction();
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->slug = Str::slug($request->name);
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->user_id = auth()->user()->id;
            $product->save();

            $dimension = new Dimension();
            $dimension->width = $request->width;
            $dimension->height = $request->height;
            $dimension->depth = $request->depth;
            $dimension->product_id = $product->id;
            $dimension->save();
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Kreiran proizvod!');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->with("error",$exception->getMessage());
        }
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
