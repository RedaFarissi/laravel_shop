@extends('layouteAdmin')

@section('title','Contacts List')

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_contacts_list') }}'>Contacts</a> > List
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/list.css') }}">
@endsection

@section('size',"aside-list")

@section('content')

<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{route('admin_contacts_delete_selected')}}" method="POST" id="delete_all_form">
            @csrf
            <div class="d-flex-between-center mb-5" >
                <h5 class="font-weight-3 mx-3">Select product to change</h5>
                <a href="{{ route('admin_contact_create_views') }}" class="add_icon_btn_in_list font-weight-3 mb-1" style="font-size:13px">
                    ADD CONTACT <div class="fa-solid fa-plus"></div>
                </a>
            </div>

            <div class="container-fluid">
                <label for="Action">Action:</label>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                <select name="action" id="Action">
                    <option value="">------------</option>
                    <option value="delete_selected_products" id="delete_selected_products" name='delete_selected_products'> Delete selected order items </option>
                </select>
                <button type="submit" form="delete_all_form" class="btn ms-1 p-1">Go </button>
                &nbsp; <span id='number_select'>0</span> of {{count($contacts)}} selected
                <div class="overflow-x-auto">
                    <table class="table table-list-width">
                        <tr>
                            <th style="width:30px">
                                <input type="checkbox" onclick="selectAll()" id="SelectAll" name="SelectAll"  value="checked">
                            </th>
                            <th class="white"> User ID</th>
                            <th class="white"> Email</th>
                            <th class="white"> Subject </th>
                            <th class="white"> Message </th>
                            <th class="white"> Created at </th>
                            <th class="white"> Updated at </th>
                        </tr>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td><input type="checkbox" onclick="selectOne()" name="selected_items[]" class="selected_items" value="{{$contact->id}}" /></td>
                                <td class="white"> <a href="{{ route('admin_contact_edit_views' , [$contact->user_id]) }}" class="blue">User {{$contact->user_id}} </a></td>
                               
                                <td class="white"> {{$contact->email}} </td>
                                <td class="white"> {{$contact->subject}} </td>
                                <td class="white"> {{$contact->message}} </td>
                                <td class="font-size-14 white" style="width:150px;">{{ $contact->created_at }}</td>
                                <td class="font-size-14 white" style="width:150px;">{{ $contact->updated_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="font-weight-3 text-secondary mt-4 fs-6" style="margin-bottom:-9px">
                    {{count($contacts)}}  @if (count($contacts)>1) orders @else order @endif
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
