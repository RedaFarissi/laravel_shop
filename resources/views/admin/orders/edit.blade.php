@extends('layouteAdmin')

@section('title','Edit Order')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/edit.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_orders_list') }}'>Order</a> > Edit
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
 
    <div class="p-4">
        <form action="{{ route('admin_order_edit' , [$order->id]) }}" method="POST">
            @csrf 
            @method('PUT')
          
                <h5 class="font-weight-3 mb-5">Edit Order</h5>
                <table class='table-create w-100'>
                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">First Name :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$order->first_name}}"
                                name="first_name" class="input-text mt-2 mb-2"  
                                id='first_name' 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('first_name')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>              
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">Last Name :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$order->last_name}}"
                                name="last_name" class="input-text mt-2 mb-2"  
                                id='last_name' 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('last_name')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>              
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">Email :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$order->email}}"
                                name="email" class="input-text mt-2 mb-2"  
                                id='email' 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('email')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>              
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">Address :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$order->address}}"
                                name="address" class="input-text mt-2 mb-2"  
                                id='address' 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('address')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>              
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">Postal Code :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$order->postal_code}}"
                                name="postal_code" class="input-text mt-2 mb-2"  
                                id='postal_code' 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('postal_code')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>              
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">City :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$order->city}}"
                                name="city" class="input-text mt-2 mb-2"  
                                id='city' 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('city')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>              
                            @enderror
                        </td> 
                    </tr>

                    <tr class="pt-3" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Paid :</b></td>
                        <td class="td"> <input type="checkbox" name="paid" value="1" id="available" class="mt-2 mb-2" @if($order->paid) checked @endif /> </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('paid')
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
                    <a href="{{ route('admin_order_delete',[$order->id]) }}" class="btn btn-danger" >Delete</a>
                </div>
           
        </form>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
@endsection