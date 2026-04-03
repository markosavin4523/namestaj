<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $query = User::with("role");
        if ($request->filled('role')) {
            $query->where("role_id",$request->role);
        }
        if ($request->filled('email')) {
            $query->where("email","like",$request->email)
            ->orWhere("username","like",$request->email);
        }
        $users = $query->paginate(10);
        return view('admin.users.users', compact('users','roles','request'));
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
        //
    }
    public function roleUpdate(Request $request, string $id)
    {
        $user = User::where("id",$id)->firstOrFail();
        if ($user->role_id == $request->role)
        {
            return back()->with("error","Korisnik vec ima izabranu ulogu");
        }
        $user->role_id = $request->role;
        $user->save();
        return back()->with("success","Uspesno ste izmijenili uloku korisniku");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
