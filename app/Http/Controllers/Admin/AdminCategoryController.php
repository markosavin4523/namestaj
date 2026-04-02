<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    protected $data = [];
    public function index()
    {
        $parentCategories = Category::where("parent_id", null)->with("children")->paginate(3);
        $data['parentCategories'] = $parentCategories;
        return view('admin.categories', $data);
    }

    public function children($id)
    {
        $children = Category::where("parent_id",$id)->get();
        return response()->json([
            'children' => $children
        ]);

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $category = new Category();
            $category->parent_id = $request->parent_id;

            $name = $request->name;
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $originalName = $name;
            $count=1;
            while (Category::withTrashed()->where("slug", $slug)->exists()) {
                $slug = $originalSlug. "-".$count;
                $name = $originalName." ".$count;
                $count++;
            }
            $category->slug =$slug;
            $category->name = $name;
            $category->save();
            return back()->with("success", "Uspsno dodata kategorija!");
        }
        catch (\Exception $exception)
        {
            return back()->with("error", $exception->getMessage());
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
        $category = Category::findOrFail($id);
        return view('admin.updateCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $cat = Category::findOrFail($id);
            if ($request->parent_id == $cat->id) {
                return back()->with("error", "Kategorija ne moze da pripada samoj sebi!");
            }
            $cat->parent_id =$request->parent_id;
            $cat->name = $request->name;
            $cat->save();
            return redirect()->route("admin.categories.index")->with("success", "Uspesno izmenjena kategorija!");
        }
        catch (\Exception $exception)
        {
            return back()->with("error", $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $uncategorizedId = 27;
        if($uncategorizedId == $id)
        {
            return back()->with("error", "Kategorija ne moze da se izbrise jer se u njoj nalaze nekategorizovani proizvodi.");
        }
        $cat = Category::where("id", $id)->with("children")->firstOrFail();

        if ($cat->parent_id == null) {
            $childrenIds = $cat->children->pluck('id');
            Product::whereIn('category_id', $childrenIds)->update(['category_id' => $uncategorizedId]);
            $cat->children()->delete();
        }
        Product::where('category_id', $cat->id)->update(['category_id' => $uncategorizedId]);
        $cat->delete();
        return back()->with("success", "Kategorija obrisana, a proizvodi prebačeni!");
    }
}
