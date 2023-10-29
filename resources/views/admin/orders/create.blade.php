@extends('layouteAdmin')

@section('title','Add Order')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/create.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_products_list') }}'>Product</a> > Create
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_order_create_store') }}" method="POST" id="delete_all_form">
            @csrf 
            <div class="mb-5 mb-4" >
                <h5 class="font-weight-3 mb-5">Add Order </h5>
                <table class='table-create w-100'>

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">First Name :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{old('first_name')}}"
                                name="first_name" class="input-text mt-2 mb-2" 
                                id='first_name' autofocus
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


                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Last Name :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{old('last_name')}}"
                                name="last_name" class="input-text mt-2 mb-2" 
                                id='last_name' autofocus
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

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Email :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{old('email')}}"
                                name="email" class="input-text mt-2 mb-2" 
                                id='email' autofocus
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


                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                            <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Address :</b> </td>
                            <td class="td"> 
                                <input 
                                    type="text" value="{{old('address')}}"
                                    name="address" class="input-text mt-2 mb-2" 
                                    id='address' autofocus
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
                    
                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Postal Code :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{old('postal_code')}}"
                                name="postal_code" class="input-text mt-2 mb-2" 
                                id='postal_code' autofocus
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

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">City :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{old('city')}}"
                                name="city" class="input-text mt-2 mb-2" 
                                id='city' autofocus
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

                
                    
                   

                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="td" colspan="2"> 
                            <input 
                                type="checkbox" name="paid" id="paid" 
                                value="1" class="mt-3 mb-2" checked
                            /> &nbsp;
                            <b class="mt-3 mb-2">Paid </b>
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('paid')
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