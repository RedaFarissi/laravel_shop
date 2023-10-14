@extends('layouteAdmin')

@section('title','Sizes List')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_sizes_list') }}'>Sizes</a> > List
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/sizes/list.css') }}"> 
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_sizes_delete_selected') }}" method="post" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select size to change</h5>
                <a href="{{ route('admin_size_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD SIZE <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_sizes" id="delete_selected_sizes" name='delete_selected_sizes'> Delete selected sizes </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($sizes)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px"> 
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th colspan="3" style="color:var(--white)"> NAME </th>
                        </tr>
                        @foreach ($sizes as $size)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$size->id}}" /></td>
                                <td><a href="{{ route('admin_size_edit_views' , [$size->id]) }}" class="blue">{{$size->name}} <a></td>
                                <td class="font-size-14" style="color:var(--white); width:150px;">{{$size->created_at}}</td>
                                <td class="font-size-14" style="color:var(--white); width:150px;">{{$size->updated_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="font-weight-3 text-secondary" style="margin-bottom:-9px"> 
                    {{count($sizes)}}  @if (count($sizes)>1) sizes @else size @endif
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
        if (selectedValue === "delete_selected_sizes") {
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