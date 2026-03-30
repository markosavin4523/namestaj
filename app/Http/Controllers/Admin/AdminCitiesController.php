<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminCitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = City::query();
        if ($request->filled('city'))
        {
            $query->where("name","like",$request->city);
        }
        $cities = $query->paginate(10);

        return view('admin.cities', compact('cities',"request"));
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
        $request->validate([
            'city' => 'required',
        ]);
        $name = $request->city;
        $city = new City();
        $city->name = $name;
        $city->save();
        return back()->with("success","Uspesno dodat grad");

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
        $city = City::findOrFail($id);
        if ($city->users()->exists() || $city->orders()->exists() ){
            return back()->with("error","Nije moguce obrisati grad koji ima korisnike ili porudzbine");
        }
        $city->delete();
        return back()->with("success","Uspesno obrisan grad");
    }
}
