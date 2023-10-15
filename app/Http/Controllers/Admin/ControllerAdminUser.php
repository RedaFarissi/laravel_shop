<?php
namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ControllerAdminUser extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }
    private function check_if_user(){
        $userId = Auth::user();
        $user = User::find($userId->id);
        return ($user->isUser())?True:False;
    }
    public function admin_users_list(){
        $is_user = $this->check_if_user();
        return ($is_user)?redirect()-> route('home'):view('admin.users.list' , ["users"=>User::all()]);
    }
    public function admin_user_create_views(){
        $is_user = $this->check_if_user();
        return ($is_user)?redirect()-> route('home'):view('admin.users.create');
    }
    public function admin_user_create_store(Request $request){
        $is_user = $this->check_if_user();
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
        event(new Registered($user));
        Auth::login($user);
        return redirect()-> route( ($request->input('submit') == "false")?"admin_user_create_views": "admin_users_list"); 
    }
    public function admin_user_edit_views($id){
        $is_user = $this->check_if_user();
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
