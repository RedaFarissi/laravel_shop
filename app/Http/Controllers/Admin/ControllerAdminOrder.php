<?php

namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ControllerAdminOrder extends Controller {
    public function __construct(){
        $this->middleware('admin');
    }
    public function admin_orders_list(){
        return view('admin.orders.list' , ["orders"=>Order::all()]);
    }
    public function admin_order_create_views(){
        return view('admin.orders.create');
    }
    public function admin_order_create_store(Request $request){ 
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string', 
            'email' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'paid' => 'required|boolean',
        ]);

        $order = new Order();
        $order->first_name = strip_tags($request->input('first_name'));
        $order->last_name = strip_tags($request->input('last_name'));
        $order->email = strip_tags($request->input('email'));
        $order->address = strip_tags($request->input('address'));
        $order->postal_code = strip_tags($request->input('postal_code'));
        $order->city = strip_tags($request->input('city'));
        $order->paid = strip_tags($request->input('paid'));
        $order->save();
        return redirect()-> route( ($request->input('submit') == "false")?
        "admin_order_create_views": "admin_orders_list"); 
    }
    public function admin_order_edit_views($id){
        return view('admin.orders.edit' , [
            "order"=>Order::findOrFail($id),
        ]);
    } 
    public function admin_order_edit(Request $request , $id){        
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string', 
            'email' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'paid' => 'required|boolean',
        ]);

        $order = Order::findOrFail($id);
        $order->first_name = strip_tags($request->input('first_name'));
        $order->last_name = strip_tags($request->input('last_name'));
        $order->email = strip_tags($request->input('email'));
        $order->address = strip_tags($request->input('address'));
        $order->postal_code = strip_tags($request->input('postal_code'));
        $order->city = strip_tags($request->input('city'));
        $order->paid = strip_tags($request->input('paid'));
        $order->save();
     
        return redirect()-> route( ($request->input('submit') == "false")?
        "admin_order_create_views": "admin_orders_list");    
    }
    public function admin_order_delete($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()-> route('admin_orders_list');
    }
    
    public function admin_orders_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            Order::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_orders_list')->with('success', 'Selected items deleted.');
    }
}
