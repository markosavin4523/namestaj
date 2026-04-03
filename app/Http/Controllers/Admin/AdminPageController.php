<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPageController extends Controller
{
    protected $date =[];
    public function index(){
        $countUsers = count(User::all());
        $countProducts = count(Product::all());
        $countOrders = count(Order::all());
        $countSoldProducts = DB::table('orders_products')->sum('quantity');
        $data['countUsers'] = $countUsers;
        $data['countProducts'] = $countProducts;
        $data['countOrders'] = $countOrders;
        $data['countSoldProducts'] = $countSoldProducts;

        return view('admin.home',$data);
    }

    public function activityIndex(Request $request){
        $query = Activity::query();
        if ( $request->filled("date_from") && $request->filled("date_to") && $request->date_from > $request->date_to)
        {
            return back()->with("error","Datum od mora biti pre datuma do!");
        }
        if ($request->filled("email")){
            $query->where("user","LIKE",$request->email. "%");
        }
        if ($request->filled("date_from")){
            $query->whereDate("date",">=",$request->date_from);
        }
        if ($request->filled("date_to")){
            $query->whereDate("date","<=",$request->date_to);
        }
        $activities = $query->orderBy("date","desc")->paginate(10);
        $data['activities'] = $activities;
        $data['request'] = $request;
        return view('admin.users.activity',$data);

    }
}
