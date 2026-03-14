<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try{
            $fields = $request->validated();
            if(Auth::attempt($fields)){
                return redirect()->route('home.index');
            }
            return back()->withErrors(["errors"=> "Ne postoji korisnik sa tim kredencijalima"]);
        }
        catch (\Exception $exception){
             return back()->withErrors(["errors"=> $exception->getMessage()]);
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back()->with('success', 'Uspešno ste se odjavili!');
    }
    public function register(RegisterRequest $request)
    {
        try {
            $request->validated();
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password =$request->password;
            $user->save();

            return redirect()->back();
        }
        catch (\Exception $e) {

        }

    }

}
