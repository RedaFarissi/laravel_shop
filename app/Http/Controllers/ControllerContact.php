<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ControllerContact extends Controller {

    public function list(){
        return view("contact.list" , ["contacts"=> Contact::all()]);
    }

    public function create(){
        return view("contact.create");
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        $contact = new Contact();
        $contact->user_id = Auth::user()->id;
        $contact->subject = strip_tags($request->input('subject'));
        $contact->email = strip_tags($request->input('email'));
        $contact->message = strip_tags($request->input('message'));
        $contact->answer = false;
        $contact->save();
        return view("contact.success");
    }

}
