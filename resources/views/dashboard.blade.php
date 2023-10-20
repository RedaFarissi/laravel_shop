<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row p-5 ">
            <div class="col-md-3 border mb-3 d-block d-flex justify-content-center align-items-center">
                <a href="{{route('products.create')}}" class="w-75" title="Add Product">
                    <img src="{{ asset('images/add_p.png') }}" class="w-100" />
                </a>
            </div>
        @foreach ($products as $product )
                <div class="col-md-3 mb-3">
                    <div class='cart-product m-auto border p-2 rounded'>
                        <a href="{{ route('products.show', [$product->id]) }}" >
                            <img class='w-100 img mb-3' src="{{ asset('storage/images/' . $product->image) }}">
                        </a>

                            <h6 class="@if(count($product->sizes)<=0) mb-2 @endif">
                                <a href="{{ route('products.show', [$product->id]) }}">
                                    <b>{{ (strlen($product->name) > 30) ? substr($product->name, 0, 30) . "..." : $product->name }}</b>
                                </a>
                            </h6>
                            <h6 class='d-flex justify-content-between align-items-center mt-2'>
                                <div class="@if(count($product->sizes)<=0) mb-2 @endif">{{ $product->price }} $ </div>
                                <a href="{{ route('dashboard_product_delete' , $product->id) }}" class="Delete rounded-circle">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>
                            </h6>
                            @if(count($product->sizes)>0)
                              <h6 class='d-flex flex-wrap'>
                                  Sizes : &nbsp;
                                @foreach ($product->sizes as $size)
                                  <kbd class="kbd">{{ $size->name }}</kbd>&nbsp;
                                @endforeach
                              </h6>
                            @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
