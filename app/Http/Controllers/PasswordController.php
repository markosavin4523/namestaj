<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    protected $data =[];
    public function edit()
    {
        $user = auth()->user();
        $this->data['user'] = $user;
        return view('user.account.account-password',$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditPasswordRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->old_password, $user->password))
        {
            return back()->with('error', 'Lozinka nije ispravna!');
        }
        $user->password = $request->password;
        $user->save();
        return back()->with('success', 'USpesno ste promenili lozinku!');
    }

}
