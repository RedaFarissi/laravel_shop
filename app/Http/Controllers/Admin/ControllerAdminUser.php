<?php
namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
//use Illuminate\Support\Facades\Auth;

class ControllerAdminUser extends Controller {
    public function __construct(){
        $this->middleware('admin');
    }
    public function admin_users_list(){
        return view('admin.users.list' , ["users"=>User::all()]);
    }
    public function admin_user_create_views(){
        return view('admin.users.create');
    }
    public function admin_user_create_store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'password' => Hash::make($request->password),
        ]);
        return redirect()-> route( ($request->input('submit') == "false")?"admin_user_create_views": "admin_users_list"); 
    }
    public function admin_user_edit_views($id){
        return view('admin.users.edit' , ["user"=>User::findOrFail($id)]);
    }
    public function admin_user_delete($id){
     
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()-> route('admin_users_list');
    }
    public function admin_users_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            User::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_users_list')->with('success', 'Selected items deleted.');
    }
}
