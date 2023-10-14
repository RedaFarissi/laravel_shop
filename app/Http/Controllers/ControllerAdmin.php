<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;

#admin create
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
#admin edit
use App\Http\Requests\ProfileUpdateRequest;

class ControllerAdmin extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function admin_home(){
        return view('admin.index');
    }

    /*********************** users *************************/

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
        event(new Registered($user));
        Auth::login($user);
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

    /************************* categories *********************** */

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


    /*********************** products *********************** */
    
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

    /*********************** sizes *********************** */
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