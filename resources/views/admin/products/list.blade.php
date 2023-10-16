@extends('layouteAdmin')

@section('title','Products list')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_categories_list') }}'>Products</a> > list
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/list.css') }}">       
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{route('admin_products_delete_selected')}}" method="POST" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select product to change</h5>
                <a href="{{ route('admin_product_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD PRODUCT <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_products" id="delete_selected_products" name='delete_selected_products'> Delete selected products </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($products)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px"> 
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th class="white"> user </th>
                            <th class="white"> Name </th>
                            <th class="white"> Price </th>
                            <th class="white"> Category</th>
                            <th class="white"> Size </th>
                            <th class="white"> Available </th>
                            <th class="white"> Created at </th>
                            <th class="white"> Updated at </th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$product->id}}" /></td>
                                <td class="white"> {{$product->user->name}} </td>
                                <td><a href="{{ route('admin_product_edit_views' , [$product->id]) }}" class="blue">{{$product->name}} <a></td>
                                <td class="white"> {{$product->price}} </td>
                                <td class="white"> {{$product->category->name}} </td>
                                <td class="white"> 
                                    @foreach ($product->sizes as $size)
                                        <kbd> {{ $size->name }}</kbd>
                                    @endforeach
                                 </td>
                                <td class="white"> 
                                    @if($product->available===1) 
                                        <input type="checkbox" checked/> 
                                    @endif 
                                </td>
                                <td class="font-size-14 white" style="width:150px;">{{ $product->created_at }}</td>
                                <td class="font-size-14 white" style="width:150px;">{{ $product->updated_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="font-weight-3 text-secondary mt-4 fs-6" style="margin-bottom:-9px"> 
                    {{count($products)}}  @if (count($products)>1) products @else product @endif
                </div>
                <hr/>
            </div>
       
        </form>
    </div>
</div>

<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
<script>
$(document).ready(function () {
    $("#delete_all_form").on("submit", function (e) {
        e.preventDefault(); 
        var selectedValue = $("#Action").val();
        if (selectedValue === "delete_selected_products") {
           this.submit(); 
        }else{
           this.reset();
        }
    });
}); 

function selectOne(){
    const checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
    const numberOfSelectedValues = checkboxes.length;
    document.getElementById('number_select').innerHTML = numberOfSelectedValues  
}


function selectAll(){
    for (var i = 0; i < document.querySelectorAll('.selected_items').length; i++) {
            document.querySelectorAll('.selected_items')[i].click();
    }
    selectOne();
}
</script>

@endsection