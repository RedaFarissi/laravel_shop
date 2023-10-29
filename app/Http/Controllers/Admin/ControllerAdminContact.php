<?php

namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class ControllerAdminContact extends Controller {
    public function __construct(){
        $this->middleware('admin');
    }
    public function admin_contacts_list(){
        return view('admin.contacts.list' , ["contacts"=>Contact::all()]);
    }
    public function admin_contact_create_views(){
        return view('admin.contacts.create',["users"=>User::all()]);
    }
    public function admin_contact_create_store(Request $request){ 
        $contact = new Contact();
        $contact->user_id = strip_tags($request->input('user_id'));
        $contact->email = strip_tags($request->input('email'));
        $contact->subject = strip_tags($request->input('subject'));
        $contact->message = strip_tags($request->input('message'));
        $contact->answer = strip_tags($request->input('answer'));

        $contact->save();
        return redirect()-> route( ($request->input('submit') == "false")?
        "admin_contact_create_views": "admin_contacts_list"); 
    }
    public function admin_contact_edit_views($id){
        return view('admin.contacts.edit' , [
            "contact"=>Contact::findOrFail($id),
        ]);
    } 
    public function admin_contact_edit(Request $request , $id){        
        // $request->validate([
        //     'user_id' => 'required|string',
        //     'email' => 'required|string',
        //     'subject' => 'required|string',
        //     'message' => 'required|string',
        //     'answer' => 'required|boolean',
        // ]);

        $contact = Contact::findOrFail($id);
        $contact->user_id = strip_tags($request->input('user_id'));
        $contact->email = strip_tags($request->input('email'));
        $contact->subject = strip_tags($request->input('subject'));
        $contact->message = strip_tags($request->input('message'));
        $contact->answer = strip_tags($request->input('answer'));;
        $contact->save();
     
        return redirect()-> route( ($request->input('submit') == "false")?
        "admin_contact_create_views": "admin_contacts_list");    
    }
    public function admin_contact_delete($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()-> route('admin_contacts_list');
    }
    
    public function admin_contacts_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            Contact::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_contacts_list');
    }
}
