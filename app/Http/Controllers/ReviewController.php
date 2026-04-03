<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request,string $slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();

        $query = $product->reviews();
        switch ($request->sort) {
            case 'rateAsc':
                $query->orderBy('rate', 'asc');
                break;
            case 'rateDesc':
                $query->orderBy('rate', 'desc');
                break;
            case 'dateAsc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'dateDesc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        $reviews = $query->paginate(10)->withQueryString();
        return view('products.reviews',compact('product','reviews','request'));
    }
    public function store(Request $request)
    {
        try{
            if (auth()->user()->reviews()->where('product_id', $request->product_id)->exists()) {
                return back()->with("error", "Već ste uneli recenziju za ovaj proizvod");
            }
            $request->validate([
                'comment' => 'nullable|string',
                "rating" => "required|numeric|min:1|max:5",
            ]);

            $review = new Review();
            $review->comment = $request->comment;
            $review->rate= $request->rating;
            $review->product_id = $request->product_id;
            $review->user_id = auth()->user()->id;
            $review->save();
            return back()->with('success', 'Dodata recenzija');
        }
        catch (\Exception $ex){
           return back()->with("error", $ex->getMessage());
        }

    }
}
