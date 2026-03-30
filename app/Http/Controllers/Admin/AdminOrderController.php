<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'status','details','products.image']);
        $statuses = OrderStatus::all();

        if ($request->filled('email'))
        {
            $query->whereHas("user", function ($q) use ($request) {
                $q->where("email","like",$request->email)
                ->orWhere("username","like",$request->email);
            });
        }
        if ($request->filled('order'))
        {
            $query->where("order_number","like",$request->order);
        }
        $orders = $query->orderBy('order_status_id')->paginate(10);

        return view('admin.orders', compact('orders','request','statuses'));
    }
    public function statusesIndex()
    {
        $statuses = OrderStatus::paginate(10);
        return view('admin.order-status', compact('statuses'));
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
        $order = Order::where("id",$id)->firstOrFail();
        if ($order->order_status_id == $request->status)
        {
            return back()->with("error","Porudzbina vec ima izabrani status");
        }
        $order->order_status_id = $request->status;
        $order->save();
        return back()->with("success","Uspesno ste izmijenili status");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
