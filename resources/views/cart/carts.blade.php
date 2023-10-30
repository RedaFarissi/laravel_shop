@extends('layout')

@section('title','Cart')

@section('head')
  <link rel="stylesheet" href="{{ url('css/cart/cart.css') }}">
  <style>
    body{ background-color: var(--white)}
    @media (min-width: 1025px) {
      .h-custom {  height: 100vh !important;  }
    }
    .d-flex-response{display: flex;}
    .qt{border: none}
    @media only screen and (max-width: 670px) {
      .product{margin-bottom: 60px }
      .d-flex-response{ display: flex; justify-content: space-between;align-items: center}
      .btn-sm{
        display: inline-block;
      }
      .position-price{
        position: absolute;
        right:0;
        top:calc(100% + 2px);
      }
      [class="content d-flex-between-center flex-wrap position-relative"]{
          width: 100%;display: block; 
      }
      [class="btn btn-sm btn-outline-dark ms-3 h-75 align-self-center"]{
        margin-right:9px 
      }
    }
    @media only screen and (max-width: 400px) {
      
  .qt, .qt-plus, .qt-minus {
    display: block;
    clear:both;
  }
  .qt-box{
    display: flex;
    align-items: center;
    height: 75%;
  }
}
</style>
@endsection

@section('content')
<div class="container-cart mb-5">
    <div class="content mt-4">
      <h1>Your Cart</h1>
    </div>
    @foreach ($carts as $cart) 
       <article class="product">
          <header>
            <a class="remove">
              <img src="{{ asset('storage/images/' . $cart->image) }}" class="cover">
              <h3>
                <a href="{{ route('delete_cart_id' , $cart->id) }}" style="color: #cecece;">
                  <i class="fas fa-trash-alt text-danger"></i>
                </a>
              </h3>
            </a>
          </header>
          <div class="content" style="overflow:hidden">
            <h1>{{(strlen($cart->name)>50)?substr($cart->name, 0, 50)."...":$cart->name}}</h1>
            {{ $cart->description }}
          </div>

          <section class="content d-flex-between-center flex-wrap position-relative">
            <form action="{{ route('cart_add' , $cart->id) }}" method="POST"> 
            @csrf
            <div class="d-flex-response">
                <div class="qt-box">
                  <div class="qt-minus">-</div>
                  <div class="qt"> 
                      <input 
                        type="number" name="quantity" value="{{ $cart->quantity }}" class="ps-4 w-100 quantity"
                        id="quantity_{{ $cart->id }}" style="text-align: center;border:none;ouline:none"
                      /> 

                  </div>
                  <div class="qt-plus">+</div>
                </div>
                <button class="btn btn-sm btn-outline-dark ms-3 h-75 align-self-center" > UPDATE </button>   
            </div>
            </form> 
            <div class="position-price">
                <h2 class="full-price"> {{ $cart->price*$cart->quantity }}$ </h2>
                <h2 class="price"> {{ $cart->price}}$ </h2>
            </div>
          </section>
       </article>
    @endforeach


    <div class="w-100 alert alert-light d-flex-between-center">
      <div class="h1" style="float:clear">Total: <span>{{$total_price}}</span>$</div>
      <a href="{{ route('order_view') }}" class="btn btn-lg fs-4 rose">Checkout</a>
    </div>
</div>
<script>
 document.addEventListener("DOMContentLoaded", function() {
        const plusButtons = document.querySelectorAll(".qt-plus");
        const minusButtons = document.querySelectorAll(".qt-minus");

        plusButtons.forEach(plusButton => {
            plusButton.addEventListener("click", function() {
                const inputElement = plusButton.closest('.d-flex-response').querySelector('.quantity');
                inputElement.value = parseInt(inputElement.value) + 1;
            });
        });

        minusButtons.forEach(minusButton => {
            minusButton.addEventListener("click", function() {
                const inputElement = minusButton.closest('.d-flex-response').querySelector('.quantity');
                const currentValue = parseInt(inputElement.value);
                if (currentValue > 0) {
                    inputElement.value = currentValue - 1;
                }
            });
        });
    });
</script>
@endsection