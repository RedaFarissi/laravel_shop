@extends('layouteAdmin')

@section('title','Categories List')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_categories_list') }}'>Categories</a> > list
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/categories/list.css') }}"> 
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_categories_delete_selected') }}" method="post" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select category to change</h5>
                <a href="{{ route('admin_category_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD CATEGORY <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_categories" id="delete_selected_categories" name='delete_selected_categories'> Delete selected categories </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($categories)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px"> 
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th colspan="3" style="color:var(--white)"> NAME </th>
                        </tr>
                        @foreach ($categories as $category)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$category->id}}" /></td>
                                <td><a href="{{ route('admin_category_edit_views' , [$category->id]) }}" class="blue">{{$category->name}} <a></td>
                                <td class="font-size-14" style="color:var(--white); width:150px;">{{$category->created_at}}</td>
                                <td class="font-size-14" style="color:var(--white); width:150px;">{{$category->updated_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="font-weight-3 text-secondary" style="margin-bottom:-9px"> 
                    {{count($categories)}}  @if (count($categories)>1) categories @else category @endif
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
        if (selectedValue === "delete_selected_categories") {
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