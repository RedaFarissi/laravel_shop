@extends('layouteAdmin')

@section('title','Edit Order')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/edit.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_contacts_list') }}'>Contact</a> > Edit
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
 
    <div class="p-4">
        <form action="{{ route('admin_contact_edit' , [$contact->id]) }}" method="POST">
            @csrf 
            @method('PUT')
          
                <h5 class="font-weight-3 mb-5">Edit Order</h5>
                <table class='table-create'>
                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Order ID :</b> </td>
                        <td class="td">
                            <select id="order_id" name="order_id" class="input-select mt-2 mb-2">
                                <option value="{{$contact->id}}" selected> Order {{$order_item->id}} </option>
                                @foreach ($orders as $item)
                                    <option value="{{$item->id}}" @if($item->order_id == $order_item->id) selected @endif> Order {{$item->id}} </option>
                                @endforeach
                            </select> 
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('order_id')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>


                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2"> Product Name :</b> </td>
                        <td class="td"> 
                            <select id="product_id" name="product_id" class="input-select mt-2 mb-2">
                                <option value="{{$order_item->product_id}}" selected> Products {{substr($order_item->product->name,0,30)}} </option>
                                @foreach ($products as $item)
                                    <option value="{{$item->id}}">  {{substr($item->name, 0 , 20)}} </option>
                                @endforeach
                            </select> 
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('product_id')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>                    

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Price :</b> </td>
                        <td class="td"> 
                            <input 
                                type="number" value="{{$order_item->price}}"
                                name="price" class="input-number mt-2 mb-2" 
                                id='price' autofocus
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('price')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Quantity :</b> </td>
                        <td class="td"> 
                            <input 
                                type="number" value="{{$order_item->quantity}}"
                                name="quantity" class="input-number mt-2 mb-2" 
                                id='quantity' autofocus
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('quantity')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>
                </table>
                <div class="alert bg-dark d-flex-between-center alert-save-item mt-3">
                    <div class="alert-save-item-div">
                        <button type="submit" value="true" name="submit" class="btn bg-blue white" >Save</button>
                        <button type="submit" value="false" name="submit" class="btn bg-blue white" >Save and add another</button>
                    </div>
                    <a href="{{ route('admin_order_item_delete',[$order_item->id]) }}" class="btn btn-danger" >Delete</a>
                </div>
           
        </form>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
@endsection