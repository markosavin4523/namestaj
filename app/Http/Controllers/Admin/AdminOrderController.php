<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
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

    public function statusesStore(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $name = $request->status;
        $status = new OrderStatus();
        $status->name = $name;
        $status->save();
        return back()->with("success","Uspesno dodat status");
    }
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required',
        ]);
        $name = $request->city;
        $city = new City();
        $city->name = $name;
        $city->save();
        return back()->with("success","Uspesno dodat grad");

    }
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
    public function statusDestroy(OrderStatus $s)
    {
        if ($s->orders()->exists() ){
            return back()->with("error","Nije moguce obrisati staus koji ima porudzbine");
        }
        $s->delete();
        return back()->with("success","Status je izbrisan");
    }
}
