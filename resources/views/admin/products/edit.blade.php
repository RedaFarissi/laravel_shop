@extends('layouteAdmin')

@section('title','Product Edit')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/edit.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_products_list') }}'>Product</a> > Edit
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
 
    <div class="p-4">
        <form action="{{ route('admin_product_edit' , [$product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
          
                <h5 class="font-weight-3 mb-5">Edit Product</h5>
                <table class='table-create'>
                    <tr class="mb-2">
                        <td class="lavel-create-width td">
                            <b class="d-block mt-2 mb-2">Name :</b>
                        </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$product->name}}"
                                name="name" class="input-text mt-2 mb-2"  
                                id='name' autofocus
                            />
                        </td>
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
                        <td class="position-relative td" style="height:200px;">  
                            <input type="file" name="image" id='image' class="mt-4 ms-2 ms-0 position-absolute"/>                      
                            <img  class="image_cadr_input_file mt-2 mb-2 ms-0 h-100" src="{{asset('storage/images/' . $product->image)}}" />
                        </td>
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
                        <td class="td lavel-create-width"><b class="d-block mt-2 mb-2">Category :</b></td>
                        <td class="td"> 
                            <select id="category_id" name="category_id" class="input-select mt-2 mb-2">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if($category->name == $product->category->name) selected @endif> {{$category->name}} </option>
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
                        <td class="lavel-create-width position-a td" style="top:0"><b class="d-block mt-2 mb-2">description :</b></td>
                        <td class="td"> 
                            <textarea type="text"name="description" class="input-textarea mt-2 mb-2" id='description'>{{$product->description}}</textarea>
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('description')
                              <div class="alert alert-danger mt-2">
                                {{$message}}  
                              </div>                  
                            @enderror
                        </td> 
                    </tr>
                   
                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Price :</b></td>
                        <td class="td"> <input type="number" value="{{$product->price}}" name="price" class="input-number mt-2 mb-2" id="price"/> </td>
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

                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Sizes :</b></td>
                        <td class="td"> 
                          <div class="d-flex flex-wrap">
                            @foreach ($sizes as $size)
                              <div class="alert border border-2 border-dark d-flex-center-center mt-2 mb-2" style='width:110px;margin:2px '> 
                                <span>
                                    <input 
                                        type="checkbox" id="{{$size->name}}" name="sizes[]" 
                                        value="{{ $size->id }}" class="mt-1" 
                                        @foreach ($product->sizes as $item)
                                        
                                            @if ($item->id == $size->id)
                                              checked
                                            @endif
                                        @endforeach  
                                    />
                                @foreach ($product->sizes as $item)
                                    @if ($item == $size)
                                    
                                      checked
                                    @endif
                                @endforeach  
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
                        <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Available :</b></td>
                        <td class="td"> <input type="checkbox" name="available" value="1" id="available" class="mt-2 mb-2" @if($product->available) checked @endif /> </td>
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
                <div class="alert bg-dark d-flex-between-center alert-save-item">
                    <div class="alert-save-item-div">
                        <button type="submit" value="true" name="submit" class="btn bg-blue white" >Save</button>
                        <button type="submit" value="false" name="submit" class="btn bg-blue white" >Save and add another</button>
                    </div>
                    <a href="{{ route('admin_product_delete',[$product->id]) }}" class="btn btn-danger" >Delete</a>
                </div>
           
        </form>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
@endsection