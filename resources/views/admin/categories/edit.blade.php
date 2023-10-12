@extends('layouteAdmin')

@section('title','Category Edit')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/categories/edit.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_categories_list') }}'>Category</a> > Edit
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_category_edit' , [$category->id]) }}" method="POST">
            @csrf 
            @method('PUT')
            <div class="mb-5 mb-4" >
                <h5 class="font-weight-3 mb-5">Change category</h5>
               
                <table class='table-create'>
                    <tr class="mb-2">
                        <td  class="lavel-create-width"><b class="d-block mt-2 mb-2">Name :</b></td>
                        <td> <input type="text" value="{{$category->name}}" id="name" name="name" class="input-text mt-2 mb-2" autofocus/></td>
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

                <div class="alert bg-dark d-flex-between-center alert-save-item">
                    <div class="alert-save-item-div">
                        <button type="submit" value="true" name="submit" class="btn bg-blue white" >Save</button>
                        <button type="submit" value="false" name="submit" class="btn bg-blue white" >Save and add another</button>
                    </div>
                    <a href="{{ route('admin_category_delete' , [$category->id]) }}" class="btn btn-danger" >Delete</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
@endsection