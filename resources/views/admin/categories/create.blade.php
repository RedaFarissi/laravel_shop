@extends('layouteAdmin')

@section('title','Add Category')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/users/create.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_categories_list') }}'>Category</a> > Create
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_category_create_store') }}" method="POST" id="delete_all_form">
            @csrf 
            <div class="mb-5 mb-4" >
                <h5 class="font-weight-3 mb-5">Add category</h5>
             
                <table class='table-create'>
                    <tr class="mb-2">
                        <td class="lavel-create-width">
                            <b class="d-block mt-2 mb-2">Name :</b>
                        </td>
                        <td> 
                            <input 
                                type="text" value="{{old('name')}}" 
                                name="name" class="input-text mt-2 mb-2"
                                id='name' autofocus
                            />
                        </td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('name')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
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