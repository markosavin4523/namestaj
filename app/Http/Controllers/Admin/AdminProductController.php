<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled("name")){
            $query->where("name","like","%$request->name%");
        }
        if ($request->filled("category")){
            $query->where("category_id",$request->category);
        }

        $products = $query->paginate(12);
        return view('admin.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $childCategories = Category::whereNotNull("parent_id")->get();
        $mainCategories = Category::where("parent_id", null)->with("children")->get();
       return view('admin.products.create-product',compact('mainCategories','childCategories'));
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

            if ($request->hasFile("image"))
            {
                $image = new Image();
                $file = $request->file('image');
                $fileName = $file->store('images', 'public');
                $fileName = explode("/", $fileName)[1];

                $image->path = $fileName;
                $image->alt = $fileName;
                $image->product_id = $product->id;
                $image->save();
            }


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
        $product = Product::where("id",$id)->firstOrFail();
        $mainCategories = Category::where("parent_id", null)->with("children")->get();
        $childCategories = Category::whereNotNull("parent_id")->get();
        return view('admin.products.updateProduct',compact('mainCategories','childCategories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($id),
            ],
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'width' => 'required|numeric',
        'height' => 'required|numeric',
        'depth' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

        try {
            DB::beginTransaction();

            $product = Product::with(['dimension', 'image'])->findOrFail($id);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;

            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->save();

            $dimension = $product->dimension;
            $dimension->width = $request->width;
            $dimension->height = $request->height;
            $dimension->depth = $request->depth;
            $dimension->save();

            if ($request->hasFile('image')) {
                $oldImage = $product->image;

                if ($oldImage && Storage::disk('public')->exists('images/' . $oldImage->path)) {
                    Storage::disk('public')->delete('images/' . $oldImage->path);
                }

                $file = $request->file('image');
                $fileName = $file->store('images', 'public');
                $fileName = explode("/", $fileName)[1];

                if ($oldImage)
                {
                    $oldImage->path = $fileName;
                    $oldImage->alt = $fileName;
                    $oldImage->save();
                }
                else{
                    $image = new Image();
                    $image->path = $fileName;
                    $image->alt = $fileName;
                    $image->product_id = $product->id;
                    $image->save();

                }

            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Proizvod uspešno izmenjen!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Došlo je do greške: ' . $e->getMessage());
        }
    }
    public function quantityUpdate($id)
    {
        $product = Product::findOrFail($id);
        $product->quantity = 0;
        $product->save();
        return back()->with('success', 'Uklonjen proizvod sa stanja');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
