<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ControllerHome extends Controller
{
    public function home(){
        return view("home.index" , [
            "products" => Product::with('sizes')->where('available', true)->get()->reverse(),
            "categories" => Category::all() ,
        ] );
    }
    public function home_category_by_id($category_id=null){
        return view("home.index" , [
            "products" => Product::where('category_id', $category_id)->get() ,
            "categories" => Category::all() ,
            'category_id' => $category_id ,
        ] );
    }
    public function contact(){
        return view("home.contact");
    }
    public function about(){
        return view("home.about");
    }
}