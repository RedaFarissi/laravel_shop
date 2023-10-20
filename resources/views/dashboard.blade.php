@auth
@if(Auth::user()->role === "super admin" || Auth::user()->role === "admin")
  <div class="is_superuser position-fixed text-light">
    <div id='is_superuser_box' onmouseover="fa_lock_over()" onmouseout="fa_lock_out()">
      <a href="" class="rose btn-fa btn rounded-circle d-flex justify-content-center align-items-center" title='Products API'>
        <i class="fa-regular fa-plus fs-3 "></i>
      </a>
      <a href="" title='All Message From User' class="rose btn-fa btn rounded-circle d-flex justify-content-center align-items-center">
        <i class="fa-solid fa-envelope fs-5"></i>
      </a>
      <a href="{{ route('admin_home') }}" title='Admin' class="rose btn-fa btn rounded-circle d-flex justify-content-center align-items-center">
        <i class="fa-solid fa-unlock"></i>
      </a>
    </div>

    <button class="rose btn-fa btn rounded-circle d-flex justify-content-center align-items-center" style="position:fixed; bottom:0%; right:50%;" title='Just for admin' onmouseover="fa_lock_over()" onmouseout="fa_lock_out()">
      <i class="fa-solid fa-lock fs-5 bg-dark fs-1"></i>
    </button>
  </div>
@endif
@endauth


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
                            <div class="col-md-4">
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
