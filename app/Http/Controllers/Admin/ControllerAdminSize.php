<?php
namespace  App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerAdminSize extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    private function check_if_user(){
        $userId = Auth::user();
        $user = User::find($userId->id);
        return ($user->isUser())?True:False;
    }

    public function admin_sizes_list(){
        return view('admin.sizes.list' , ["sizes"=>Size::all()]);
    }
    public function admin_size_create_views(){ 
        return view('admin.sizes.create');
    }
    public function admin_size_create_store(Request $request){ 
        $request->validate([
            'name' => 'required|string',
        ]);
        $size = new Size();
        $size->name = strip_tags($request->input('name'));
        $size->save();
        return redirect()-> route( ($request->input('submit') == "false")?"admin_size_create_views": "admin_sizes_list");
    }
    public function admin_size_edit_views($id){
        return view('admin.sizes.edit' , ["size"=>Size::findOrFail($id)]);
    }
    public function admin_size_edit(Request $request , $id){ 
        $request->validate([
            'name' => 'required|string',
        ]);
        $size = Size::findOrFail($id);
        $size->name = strip_tags($request->input('name'));
        $size->save();
        return redirect()-> route( ($request->input('submit') == "false")?"admin_size_create_views": "admin_sizes_list"); 
    }
    public function admin_size_delete($id){
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()-> route('admin_sizes_list');
    }
    
    public function admin_sizes_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            Size::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_sizes_list')->with('success', 'Selected items deleted.');
    }
}
