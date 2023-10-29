@extends('layouteAdmin')

@section('title','Orders List')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_products_list') }}'>Products</a> > list
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/list.css') }}">
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{route('admin_orders_delete_selected')}}" method="POST" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select product to change</h5>
                <a href="{{ route('admin_order_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD ORDER <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_products" id="delete_selected_products" name='delete_selected_products'> Delete selected products </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($orders)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px">
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th class="white"> ID </th>
                            <th class="white"> First Name </th>
                            <th class="white"> Last Name </th>
                            <th class="white"> Email </th>
                            <th class="white"> Address </th>
                            <th class="white"> Postal Code </th>
                            <th class="white"> City </th>
                            <th class="white"> Paid </th>
                            <th class="white"> Created at </th>
                            <th class="white"> Updated at </th>
                        </tr>
                        @foreach ($orders as $order)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$order->id}}" /></td>
                                <td class="white"><a href="{{ route('admin_order_edit_views' , [$order->id]) }}" class="blue"> {{$order->id}} </a></td>
                                <td class="white"> {{$order->first_name}} </td>
                                <td class="white"> {{$order->last_name}} </td>
                                <td class="white"> {{$order->email}} </td>
                                <td class="white"> {{$order->address}} </td>
                                <td class="white"> {{$order->postal_code}} </td>
                                <td class="white"> {{$order->city}} </td>
                                <td class="white"> 
                                    @if($order->paid)
                                        <div class="rounded-circle border box-icon d-flex-center-center border-success">
                                            <i class="fa-solid fa-check text-success"></i>
                                        </div>
                                    @else 
                                        <div class="rounded-circle border box-icon d-flex-center-center border-danger">
                                            <i class="fa-solid fa-xmark text-danger"></i> 
                                        </div>
                                    @endif 
                                </td>
                                <td class="font-size-14 white" style="width:150px;">{{ $order->created_at }}</td>
                                <td class="font-size-14 white" style="width:150px;">{{ $order->updated_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="font-weight-3 text-secondary mt-4 fs-6" style="margin-bottom:-9px">
                    {{count($orders)}}  @if (count($orders)>1) orders @else order @endif
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
