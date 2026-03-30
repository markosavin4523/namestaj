<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $request){
        try {
            $message = new Contact();
            $message->name = $request->name;
            $message->question = $request->question;
            $message->email = $request->email;
            $message->save();

            return back()->with("success","Vasa poruka je poslata");
        }
        catch (\Exception $exception){
            return back()->with("error","Doslo je do greske");
        }
    }
}
