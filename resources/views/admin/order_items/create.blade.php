@extends('layouteAdmin')

@section('title','Add Order')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/create.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_order_items_list') }}'>OrderItem</a> > Create
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_order_item_create_store') }}" method="POST" id="delete_all_form">
            @csrf 
            <div class="mb-5 mb-4" >
                <h5 class="font-weight-3 mb-5">Add OrderItem</h5>
                <table class='table-create w-100'>

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Order ID :</b> </td>
                        <td class="td"> 
                            <select id="order_id" name="order_id" class="input-select mt-2 mb-2">
                                <option value="" selected> ........... </option>
                                @foreach ($orders as $order)
                                    <option value="{{$order->id}}"> Order {{$order->id}} </option>
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
                                <option value="" selected> ........... </option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">  {{substr($product->name, 0 , 20)}} </option>
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
                                type="number" value="{{old('price')}}"
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
                                type="number" value="{{old('quantity')}}"
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

                <hr/>
                <div class="alert-save-item alert bg-dark">
                    <button type="submit" value="true" name="submit" class="btn bg-blue white" >Save</button>
                    <button type="submit" value="false" name="submit" class="btn bg-blue white" >Save and add another</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>

@endsection