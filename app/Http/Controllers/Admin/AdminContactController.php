<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index(Request $request){
        $messages = Contact::orderBy("is_seen","asc")
        ->orderBy("is_seen")->paginate(10);
        return view('admin.contact', compact('messages'));
    }
    public function show(Contact $c){
        if ($c->is_seen == false)
        {
            $c->is_seen = true;
            $c->save();
        }
        return view('admin.showContact', compact('c'));
    }
}
