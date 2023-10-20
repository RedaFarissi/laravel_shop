@extends('layout')

@section('title')
    {{ $product->name }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ url('css/products/detail.css') }}">
@endsection

@section('content')
    <div style='height:80vh' class='container d-flex justify-content-center align-items-center'>
        <div class='row detail_page' >
            <div class='col-md-5 d-flex justify-content-center'  style="height:520px;">
                <img class='img-detail'  src="{{ asset('storage/images/' . $product->image) }}">
            </div>
            <div class='col-md-1'> </div>
            <div class='col-md-6 d-flex align-items-center'>
                <div class='mt-2'>
                    <h2>{{ $product->name}}</h2>
                    <h3> <a href="">  product.category  </a> </h3>
                    <p class="price">  {{$product->price}} $ </p>
                    @if(count($product->sizes)>0)
                        <h6 class='d-flex flex-wrap'>
                            Sizes : &nbsp;
                          @foreach ($product->sizes as $size)
                            <kbd>{{ $size->name }}</kbd>&nbsp;
                          @endforeach
                        </h6>
                    @endif
                    {{ $product->description }}

                    <form action="" method="post">
                        <input type="submit" value="Add to cart" class='btn slected border_dark mt-4'>
                    </form>

                    {{-- <a href="{{ route('products.edit' , [$product->id] ) }}" class="btn btn-primary mt-2">Edit</a>


                    <form action="{{ route('products.destroy' , [$product->id] ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger mt-2"/>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
