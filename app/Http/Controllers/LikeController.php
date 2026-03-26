<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $data = [];
    public function index(){
        $user = auth()->user();
        if($user){
            $productIds = $user->likes->pluck('product_id');
        }
        else{
            $productIds = session()->get('guest_likes', []);
        }
        $products = Product::whereIn('id', $productIds)->with(['category.parent'])->paginate(15);
        $this->data['products'] = $products;
        return view('products.likes', $this->data);
    }
    public function like($id)
    {
        $user = auth()->user();
        $status = '';
        $count = 0;
        if ($user) {
            // Logika za ulogovanog korisnika (Baza)
            $like = Like::where('user_id', $user->id)
                ->where('product_id', $id)
                ->first();

            if ($like) {
                $like->delete();
                $status = 'unliked';
            } else {
                Like::create([
                    'user_id' => $user->id,
                    'product_id' => $id
                ]);
                $status = 'liked';
            }
            $count = auth()->user()->likes()->count();
        } else {
            $sessionLikes = session()->get('guest_likes', []);

            if (in_array($id, $sessionLikes)) {
                $sessionLikes = array_diff($sessionLikes, [$id]);
                $status = 'unliked';
            } else {
                $sessionLikes[] = $id;
                $status = 'liked';
            }
            session()->put('guest_likes', $sessionLikes);
            $count = count(session()->get('guest_likes', []));
        }

        return response()->json([
            'status' => $status,
            'count'=> $count
        ]);
    }
}
