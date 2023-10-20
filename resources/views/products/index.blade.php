@extends('layout')

@section('title','MyShop')

@section('head')
    <link rel="stylesheet" href="{{ url('css/products/products.css') }}">
@endsection

@section('content')
<main class='main'>
  <div class="row justify-content-center p-0 mb-5 pb-5">
      @foreach ($products as $product )
          <div class="col-md-4 p-0 mb-4">
              <div class='cart-product m-auto border p-2 rounded'>
                  <a href="{{ route('products.show', [$product->id]) }}" >
                      <img class='w-100 img mb-3' src="{{ asset('storage/images/' . $product->image) }}">
                  </a>

                  <a href="{{ route('products.show', [$product->id]) }}">
                      <h6 class="@if(count($product->sizes)<=0) mb-2 @endif">
                          <b>{{(strlen($product->name) > 30) ? substr($product->name, 0, 30) . "..." : $product->name }}</b>
                      </h6>
                      <h6 class='d-flex justify-content-between align-items-center mt-2 @if(count($product->sizes)<=0) mb-2 @endif'>
                        {{ $product->price }} $
                      </h6>
                      @if(count($product->sizes)>0)
                        <h6 class='d-flex flex-wrap'>
                            Sizes : &nbsp;
                          @foreach ($product->sizes as $size)
                            <kbd>{{ $size->name }}</kbd>&nbsp;
                          @endforeach
                        </h6>
                      @endif
                  </a>
              </div>
          </div>
        @endforeach
  </div>
</main>
@endsection
