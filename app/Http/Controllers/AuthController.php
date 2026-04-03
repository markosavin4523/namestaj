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
                if (auth()->user()->status == 0) {
                    Auth::logout();
                    return back()->with('error', 'Vaš nalog je banovan. Kontaktirajte podršku.');
                }
                if (auth()->user()->role_id == 1) {

                    return redirect()->route('admin.home.index');
                }
                return redirect()->route('home.index')->with('success', 'Uspesno ste se ulogovali');
            }
            return back()->with('error',"Ne postoji korisnik sa tim kredencijalima");
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
        return redirect()->route('home.index')->with('success', 'Uspešno ste se odjavili!');
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

            Auth::login($user);
            return redirect()->back();
        }
        catch (\Exception $e) {
            return back()->with("error","Doslo je do greske");
        }

    }

}
