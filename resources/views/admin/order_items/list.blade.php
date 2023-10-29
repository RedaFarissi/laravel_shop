@extends('layouteAdmin')

@section('title','OrderItems List')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_order_items_list') }}'>OrderItems</a> > list
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/list.css') }}">
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{route('admin_order_items_delete_selected')}}" method="POST" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select product to change</h5>
                <a href="{{ route('admin_order_item_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD PRODUCT <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_products" id="delete_selected_products" name='delete_selected_products'> Delete selected order items </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($order_items)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px">
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th class="white"> Order ID</th>
                            <th class="white"> Product Name</th>
                            <th class="white"> Price </th>
                            <th class="white"> Quantity </th>
                            <th class="white"> Created at </th>
                            <th class="white"> Updated at </th>
                        </tr>
                        @foreach ($order_items as $item)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$item->id}}" /></td>
                                <td class="white"> <a href="{{ route('admin_order_item_edit_views' , [$item->id]) }}" class="blue">Order {{$item->order_id}} </a></td>
                                <td class="white"> {{substr($item->product->name , 0,70)}} </td>
                                <td class="white"> {{$item->price}} </td>
                                <td class="white"> {{$item->quantity}} </td>
                                <td class="font-size-14 white" style="width:150px;">{{ $item->created_at }}</td>
                                <td class="font-size-14 white" style="width:150px;">{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="font-weight-3 text-secondary mt-4 fs-6" style="margin-bottom:-9px">
                    {{count($order_items)}}  @if (count($order_items)>1) orders @else order @endif
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
