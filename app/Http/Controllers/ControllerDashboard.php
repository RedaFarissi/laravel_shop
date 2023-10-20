<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ControllerDashboard extends Controller
{
    public function dashboard() {
        $auth = Auth::user();
        return view('dashboard' , [
            // i created scope in Product Models
            'products'=> Product::productsFromSpecificUser($auth->id)->with('sizes')->get()
        ]);
    }


    public function dashboard_product_delete($id) {
        $to_delete = Product::findOrFail($id);
        $to_delete->delete();
        return redirect()->route('dashboard');
    }
}
