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
        $activities = Activity::latest()->paginate(10);
        $data['activities'] = $activities;
        return view('admin.activity',$data);

    }
}
