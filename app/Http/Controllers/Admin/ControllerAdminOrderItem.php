<?php

namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class ControllerAdminOrderItem extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function admin_order_items_list(){
        return view('admin.order_items.list' , ["order_items"=>OrderItem::all()]);
    }
    public function admin_order_item_create_views(){
        return view('admin.order_items.create',["products"=>Product::all(), "orders"=>Order::all()]);
    }
    public function admin_order_item_create_store(Request $request){ 

        $order_item = new OrderItem();
        $order_item->order_id = strip_tags($request->input('order_id'));
        $order_item->product_id = strip_tags($request->input('product_id'));
        $order_item->price = strip_tags($request->input('price'));
        $order_item->quantity = strip_tags($request->input('quantity'));
        $order_item->save();

        return redirect()-> route( ($request->input('submit') == "false")?
        "admin_order_item_create_views": "admin_order_items_list"); 
    }
    public function admin_order_item_edit_views($id){
        return view('admin.order_items.edit' , [
            "order_item"=>OrderItem::findOrFail($id),
            "products"=>Product::all(), "orders"=>Order::all()
        ]);
    } 
    public function admin_order_item_edit(Request $request , $id){        
        $order_item = OrderItem::findOrFail($id);
        $order_item->order_id = strip_tags($request->input('order_id'));
        $order_item->product_id = strip_tags($request->input('product_id'));
        $order_item->price = strip_tags($request->input('price'));
        $order_item->quantity = strip_tags($request->input('quantity'));
        $order_item->save();
     
        return redirect()-> route( ($request->input('submit') == "false")?
        "admin_order_item_create_views": "admin_order_items_list");    
    }
    public function admin_order_item_delete($id){
        $order_item = OrderItem::findOrFail($id);
        $order_item->delete();
        return redirect()-> route('admin_order_items_list');
    }
    
    public function admin_order_items_delete_selected(Request $request){
        $selectedItems = $request->input('selected_items');
        if (!is_null($selectedItems) && is_array($selectedItems)) {
            OrderItem::whereIn('id', $selectedItems)->delete();
        }
        return redirect()->route('admin_order_items_list')->with('success', 'Selected items deleted.');
    }
}
