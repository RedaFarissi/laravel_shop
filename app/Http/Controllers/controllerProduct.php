<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;

class controllerProduct extends Controller{
    public function __construct(){
        $this->middleware('auth')->only('create','store');
    }
    
    public function index() {
       return view('products.index' , ['products'=> Product::with('sizes')->get()]);
    }

    // go to create.blade.php in views/home/create.blade.php
    public function create(){
        return view('products.create', ["categories"=>Category::all() , "sizes"=>Size::all()]);
    }
    
    //handle create product 
    public function store(Request $request){ 
        //check for validity  
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
        $product->choices = strip_tags($request->input('choices'));
        $product->category_id = strip_tags($request->input('category_id'));
        
        $product->image = $imageName; // Save only the image name
        $product->save();
        return redirect()-> route('products.index');
    }

    // to get detail by id if exist
    public function show($id){ 
        return view('products.show', ["product" => Product::findOrFail($id)] );
    }

    //go to home/edit.blade.php  by id
    public function edit(string $id){  
        return view('products.edit', ["product" => Product::findOrFail($id)] );
    }

    //Logic server when user edit somthing by id 
    public function update(Request $request, string $id){  
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            'description' => 'required|string',
            'price' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath); // Get the file name without the path
    
        $up_date = Product::findOrFail($id);
        $up_date->name = strip_tags($request->input('name'));
        $up_date->description = strip_tags($request->input('description'));
        $up_date->price = strip_tags($request->input('price'));
        $up_date->available = strip_tags($request->input('available'));
        
        $up_date->image = $imageName; // Save only the image name
        $up_date->save();
        return redirect()-> route('products.show' , $id);
    }

    public function destroy(string $id){  
        $to_delete = Product::findOrFail($id);
        $to_delete->delete();
        return redirect()-> route('products.index');
    }
}
