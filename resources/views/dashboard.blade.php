<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
                <div class="p-6 text-gray-900">
                    
                    <div class="row p-0">
                        @foreach ($products as $product )
                            <div class="col-md-4 p-0 mb-4 m-2">
                                <div class='cart-product m-auto border p-2 rounded'>
                                    <a href="{{ route('products.show', [$product->id]) }}" >
                                        <img class='w-100 img mb-3' src="{{ asset('storage/images/' . $product->image) }}">
                                    </a>
                  
                                    <a href="{{ route('products.show', [$product->id]) }}">
                                        <h6 class="@if(count($product->sizes)<=0) mb-2 @endif">
                                            <b>{{ $product->name }}</b>
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
                </div>
     
        </div>
    </div>
</x-app-layout>
