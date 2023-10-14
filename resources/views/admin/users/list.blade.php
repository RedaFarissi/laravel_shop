@extends('layouteAdmin')

@section('title','Users list')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_users_list') }}'>Users</a> > list
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/users/list.css') }}">       
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{route('admin_users_delete_selected')}}" method="POST" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select user to change</h5>
                <a href="{{ route('admin_user_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD USER <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_products" id="delete_selected_products" name='delete_selected_products'> Delete selected users </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($users)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px"> 
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th class="white"> Name </th>
                            <th class="white"> Email </th>
                            <th class="white"> Email verified</th>
                            <th class="white"> Created at </th>
                            <th class="white"> Updated at </th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$user->id}}" /></td>
                                <td><a href="{{ route('admin_user_edit_views' , [$user->id]) }}" class="blue">{{$user->name}} <a></td>
                                <td class="white"> {{$user->email}} </td>
                                <td class="white" > @if(is_null($user->email_verified_at)) <span class="text-danger">not verified</span> @else <span class="text-success">verified</span> @endif</td>
                                
                                <td class="font-size-14 white" style="width:150px;">{{ $user->created_at }}</td>
                                <td class="font-size-14 white" style="width:150px;">{{ $user->updated_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="font-weight-3 text-secondary mt-4 fs-6" style="margin-bottom:-9px"> 
                    {{count($users)}}  @if (count($users)>1) products @else product @endif
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