<?php
namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ControllerAdminCategory extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    private function check_if_user(){
        $userId = Auth::user();
        $user = User::find($userId->id);
        return ($user->isUser())?True:False;
    }

    public function admin_categories_list(){
        return view('admin.categories.list' , ["categories"=>Category::all()]);
    }
    
    public function admin_category_create_views(){
        return view('admin.categories.create');
    }
    public function admin_category_create_store (Request $request){ 
        $request->validate([
            'name' => 'required|string',
        ]);
        $category = new Category();
        $category->name = strip_tags($request->input('name'));
        $category->save();
        return redirect()-> route( ($request->input('submit') == "false")?"admin_category_create_views": "admin_categories_list");
    }
    public function admin_category_edit_views($id){
        return view('admin.categories.edit' , ["category"=>Category::findOrFail($id)]);
    }
    public function admin_category_edit(Request $request , $id){ 
        $request->validate([
            'name' => 'required|string',
        ]);
        $category = Category::findOrFail($id);
        $category->name = strip_tags($request->input('name'));
        $category->save();
        return redirect()-> route( ($request->input('submit') == "false")?"admin_category_create_views": "admin_categories_list"); 
    }
    public function admin_category_delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()-> route('admin_categories_list');
    }
    
    public function admin_categories_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            Category::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_categories_list')->with('success', 'Selected items deleted.');
    }

}
