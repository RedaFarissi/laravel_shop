<?php
namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ControllerAdminProduct extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    private function check_if_user(){
        $userId = Auth::user();
        $user = User::find($userId->id);
        return ($user->isUser())?True:False;
    }

    public function admin_products_list(){
        return view('admin.products.list' , ["products"=>Product::with('sizes')->get()]);
    }
     
    public function admin_product_create_views(){
        return view('admin.products.create' , ["categories"=>Category::all() , "sizes"=>Size::all()] );
    }
    public function admin_product_create_store(Request $request){ 
        //dd($request->input('sizes'));
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string',
            'price' => 'required|integer',
            'available' => 'required|boolean',
        ]);
        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath); // Get the file name without the path
    
        $product = new Product();
        $product->name = strip_tags($request->input('name'));
        $product->description = strip_tags($request->input('description'));
        $product->price = strip_tags($request->input('price'));
        $product->available = strip_tags($request->input('available'));
        $product->category_id = strip_tags($request->input('category_id'));
        $product->image = $imageName; // Save only the image name
        $product->save();

        //Attach selected sizes to the product 
        $product->sizes()->attach($request->input('sizes'));
        
        return redirect()-> route( ($request->input('submit') == "false")?"admin_product_create_views": "admin_products_list"); 
    }
    public function admin_product_edit_views($id){
        return view('admin.products.edit' , [
            "product"=>Product::findOrFail($id),
            "categories"=>Category::all() ,
            "sizes"=>Size::all()
        ]);
    } 
    public function admin_product_edit(Request $request , $id){        
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string',
            'price' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath); // Get the file name without the path
       
        $product = Product::findOrFail($id);
        $product->name = strip_tags($request->input('name'));
        $product->description = strip_tags($request->input('description'));
        $product->price = strip_tags($request->input('price'));
        $product->available = strip_tags($request->input('available'));
        $product->category_id = strip_tags($request->input('category_id'));
        $product->image = $imageName; // Save only the image name
        $product->save();
        $product->sizes()->sync($request->input('sizes')); // Use sync to update the relationship
        return redirect()-> route( ($request->input('submit') == "false")?"admin_product_create_views": "admin_products_list");    
    }
    public function admin_product_delete($id){
        $category = Product::findOrFail($id);
        $category->delete();
        return redirect()-> route('admin_products_list');
    }
    
    public function admin_products_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            Product::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_products_list')->with('success', 'Selected items deleted.');
    }
}
