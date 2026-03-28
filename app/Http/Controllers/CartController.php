<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $data = [];

    public function index()
    {
        $user = auth()->user();
        if ($user) {
            $cart= $user->carts()->with('products.image')->first();
            $products = $cart ? $cart->products : [];
            $cartPrice =$cart ? $cart->totalPrice() : 0;

        }
        else {

            $cart = session()->get('cart', []);
            $productIds = array_keys($cart);

            $products = Product::whereIn('id', $productIds)->with(['image'])->get();
            $cartPrice = 0;
            foreach ($products as $product) {
                $quantity = $cart[$product->id]['quantity'] ?? 0;
                $price = $product->price ?? 0;
                $cartPrice += $price * $quantity;
            }
        }
        $data['cart'] = $cart;
        $data['products'] = $products;
        $data['cartPrice'] = $cartPrice;
        return view('products.cart',$data);
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
    public function store(Request $request, int $id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);
        $quantity = $request->quantity;

        if ($user){
            if ($user->carts()->first())
            {
                $cart = $user->carts()->first();
            }
            else
            {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->save();
            }
            if ($cart->products()->where('product_id', $product->id)->first())
            {
                $quantity = $cart->products()->where('product_id', $product->id)->first()->pivot->quantity + $quantity;
                $cart->products()->updateExistingPivot($id, [
                    'quantity' => $quantity
                ]);
            }
            else{
                $cart->products()->attach($product->id, ['quantity' => $quantity]);

            }
            $count = $cart->products()->count();
        }
        else{
            $sessionCart = session()->get('cart', []);
            if (isset($sessionCart[$product->id])) {
                $sessionCart[$product->id]['quantity'] += $quantity;
            } else {
                $sessionCart[$product->id] = [
                    'quantity' => $quantity
                ];
            }

            session()->put('cart', $sessionCart);
            $count = count($sessionCart);
        }


    return response()->json([
        'success'=>'Dodali ste proizvod u korpu',
        'count'=>$count,
        'message'=>'Dodali ste proizvod u korpu'
    ]);

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
    public function destroy(int $id)
    {
        $user = auth()->user();
        if ($user){
            $cart = $user->carts()->first();
            $product= $cart->products()->where('product_id', $id)->first();
            $cart->products()->detach($product->id);
        }
        else{
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Uspesno ste uklonili proizvod iz korpe!');
    }
}
