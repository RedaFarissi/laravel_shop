@extends('layout')

@section('title', "My Shop Detail")

@section('content')
<main class="mt-5 pt-4">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 ps-2 mb-4 d-flex-center" style="max-height: 550px">
                <img src="{{ asset('storage/images/' . $product->image) }}" class="img-fluid h-100"  />
            </div>

            <div class="col-md-6 mb-4 d-flex align-items-center">
                <div class="p-4">
                    <div class="mb-3">
                        <a href="{{ route('home_category_by_id', $product->category->id) }}">
                            <span class="badge bg-dark me-1">{{$product->category->name}}</span>
                        </a>
                        <a> <span class="badge bg-info me-1">New</span> </a>
                        <a> <span class="badge bg-danger me-1">avialable</span> </a>
                    </div>

                    <p class="lead"> <span>${{$product->price}}</span> </p>

                    <strong><p style="font-size: 18px;">{{ $product->name}}</p></strong>

                    <p> {{ $product->description }} </p>

                    <form action="{{ route('cart_add', $product->id) }}" method="POST" class="d-flex justify-content-left">
                        @csrf
                        <div class="form-outline me-1" style="width: 100px;">
                            <input type="number" name="quantity" value="{{1}}" class="form-control" />
                        </div>
                        <button class="btn btn-primary ms-1" type="submit">
                            Add to cart
                            <i class="fas fa-shopping-cart ms-1"></i>
                        </button>
                    </form>

                    @if(count($product->sizes)>0)
                        <h6 class='d-flex flex-wrap mt-3'>
                            Sizes : &nbsp;
                          @foreach ($product->sizes as $size)
                            <kbd>{{ $size->name }}</kbd>&nbsp;
                          @endforeach
                        </h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
