<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfilePersonalInfoRequest;
use App\Http\Requests\EditProfileRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   protected $data = [];
    public function indexRequiredInfo()
    {
        $data['user'] = auth()->user();
        return view('user.account.account-info',$data);
    }
    public function indexPersonalInfo()
    {
        $data['cities'] = City::all();
        $data['user'] = auth()->user();
        return view('user.account.account-personal-info',$data);
    }
    public function indexDeleteAcc()
    {
        $data['user'] = auth()->user();
        return view('user.account.account-delete',$data);
    }
    // Update data
    public function updateRequiredInfo(EditProfileRequest $request)
    {
        try {
            $user = auth()->user();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->username = $request->username;

            $user->save();
            return redirect()->back()->with('success', 'Uspesno sacuvane izmene.');
        }
        catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

    }
    public function updatePersonalInfo(EditProfilePersonalInfoRequest $request)
    {
        try {
            $user = auth()->user();
            $user->info->zip = $request->zip;
            $user->info->city_id = $request->city;
            $user->info->address = $request->address;
            $user->info->phone = $request->phone;

            $user->info->save();
            return redirect()->back()->with('success', 'Uspesno sacuvane izmene.');
        }
        catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }


}
