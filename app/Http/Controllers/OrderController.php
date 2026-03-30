<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\City;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $data = [];
    public function index()
    {
        $orders = auth()->user()->orders()
            ->whereIn('order_status_id', [1, 2])
            ->with('status')
            ->orderBy("created_at", "desc")
            ->paginate(10);
        $data['orders'] = $orders;
        return view('user.orders.orders', $data);
    }
    public function indexHistory()
    {
        $orders = auth()->user()->orders()
            ->where('order_status_id', 3)
            ->with('status')
            ->orderBy("created_at", "desc")
            ->paginate(10);
        $data['orders'] = $orders;
        return view('user.orders.orders-history', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        $user = auth()->user();
        if ($user) {
            $cart = $user->carts()->first();
            $cartPrice = $cart->totalPrice();

        }
        else{
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

        $this->data['cities'] = $cities;
        $this->data['cart'] = $cart;
        $this->data['cartPrice'] = $cartPrice;
        return view('user.orders.checkout', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $user = auth()->user();
        if ($user) {
            $userId = $user->id;
            $cart = $user->carts()->first();
            $products = $cart ? $cart->products : [];
            $totalPrice = $cart ? $cart->totalPrice() : 0;
        }
        else{
            $userId = null;
            $cartSession = session()->get('cart', []);
            $productIds = array_keys($cartSession);
            $products = Product::whereIn('id', $productIds)->get();

            $totalPrice = 0;
            foreach ($products as $p) {
                $totalPrice += ($p->price ?? 0) * ($cartSession[$p->id]['quantity'] ?? 0);
            }
        }
        if ($products->isEmpty()) {
            return redirect()->back()->with('error', 'Korpa je prazna!');
        }
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->order_number = $order->generateOrderNumber();
            $order->user_id = $userId;
            $order->order_status_id = 1;
            $order->total_price = $totalPrice;
            $order->save();

            $orderDet = new OrderDetail();
            $orderDet->first_name = $request->first_name;
            $orderDet->last_name = $request->last_name;
            $orderDet->phone = $request->phone;
            $orderDet->address = $request->address;
            $orderDet->city_id = $request->city;
            $orderDet->zip = $request->zip;
            $orderDet->order_id = $order->id;
            $orderDet->save();

            foreach ($products as $p) {
                $qty = $user ? $p->pivot->quantity : $cartSession[$p->id]['quantity'];
                if ($p->quantity < $qty) {
                    throw new \Exception("Nedovoljno zaliha za proizvod: {$p->name}");
                }
                $order->products()->attach($p->id, [
                    'quantity' => $qty,
                    'price' => $p->price ?? 0
                ]);
                $p->decrement('quantity', $qty);
            }
            if ($user) {
                $user->carts()->delete();
            } else {
                session()->forget('cart');
            }
            DB::commit();
            return redirect()->route('home.index')->with('success', 'Vasa porudzbina je u obradi!');

        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
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
