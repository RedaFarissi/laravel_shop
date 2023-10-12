@extends('layouteAdmin')

@section('title','Product Create')

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
        <form action="{{ route('admin_product_create_store') }}" method="POST" id="delete_all_form" enctype="multipart/form-data">
            @csrf 
            <div class="mb-5 mb-4" >
                <h5 class="font-weight-3 mb-5">Add product</h5>
                <table class='table-create'>
                    <tr class="mb-2">
                            <td class="lavel-create-width td">
                                <b class="d-block mt-2 mb-2">Name :</b>
                            </td>
                            <td class="td"> 
                                <input 
                                    type="text" value="{{old('name')}}"
                                    name="name" class="input-text mt-2 mb-2" 
                                    id='name' autofocus
                                />
                            </td>
                        </div>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('name')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>

                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Image :</b></td>
                        <td class="td">  <input type="file" value="{{old('image')}}" name="image" id='image' class="mt-2 mb-2"/> </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                           @error('image')
                             <div class="alert alert-danger mt-2">
                                {{$message}}  
                             </div>                
                           @enderror
                        </td> 
                    </tr>

                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Category :</b></td>
                        <td class="td"> 
                            <select id="category_id" name="category_id" class="input-select mt-2 mb-2">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}"> {{$category->name}} </option>
                                @endforeach
                            </select> 
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('category_id')
                                <div class="alert alert-danger mt-2">
                                   {{$message}}  
                                </div>                
                            @enderror
                        </td> 
                    </tr>

                    <tr class="position-r" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width position-a td" style="top:0">
                            <b class="d-block mt-2 mb-2" >description :</b>
                        </td>
                        <td class="td"> 
                            <textarea type="text" name="description" class="input-textarea mt-2 mb-2" id='description'>{{old('description')}}</textarea>
                        </td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('description')
                              <div class="alert alert-danger mt-2">
                                {{$message}}  
                              </div>                  
                            @enderror
                        </td> 
                    </tr>
                   

                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Price :</b></td>
                        <td class="td"> <input type="number" value="{{old('price')}}" name="price" class="input-number mt-2 mb-2" id="price"/> </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('price')
                              <div class="alert alert-danger mt-2">
                                {{$message}}  
                              </div>                  
                            @enderror
                        </td> 
                    </tr>

                    <tr class="position-r" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width position-a td" style="top:0">
                            <b class="d-block mt-2 mb-2">Sizes :</b>
                        </td>
                        <td class="td"> 
                            <div class="d-flex flex-wrap">
                                @foreach ($sizes as $size)
                                  <div class="alert border border-2 border-dark d-flex-center-center mt-2 mb-2" style='width:110px;margin:2px '> 
                                    <span>
                                        <input type="checkbox" id="{{$size->name}}" name="sizes[]" value="{{ $size->id }}" class="mt-1"/>
                                    </span>  &nbsp;
                                    <span style="font-size:12px">{{ $size->name }}</span> 
                                  </div> 
                                @endforeach  
                            </div>  
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('sizes')
                              <div class="alert alert-danger mt-2">
                                {{$message}}  
                              </div>                  
                            @enderror
                        </td> 
                    </tr>
                   

                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="td" colspan="2"> 
                            <input 
                                type="checkbox" name="available" id="available" 
                                value="1" class="mt-3 mb-2" checked
                            /> &nbsp;
                            <b class="mt-3 mb-2">Available </b>
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('available')
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