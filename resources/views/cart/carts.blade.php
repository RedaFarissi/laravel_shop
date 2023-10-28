@extends('layout')

@section('title','Cart')

@section('head')
  <link rel="stylesheet" href="{{ url('css/cart/cart.css') }}">
  <style>
    body{ background-color: var(--white)}
    @media (min-width: 1025px) {
      .h-custom {  height: 100vh !important;  }
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
          <div class="content">
            <h1>{{(strlen($cart->name)>50)?substr($cart->name, 0, 50)."...":$cart->name}}</h1>
            {{ $cart->description }}
          </div>

          <section class="content">
            <div class="qt-box">
              <span class="qt-minus">-</span>
              <span class="qt">  
                  <input type="number" id='' value="{{ $cart->quantity }}" class="ps-4 w-100"
                  style="text-align: center;border:none;ouline:none "/> 
              </span>
              <span class="qt-plus">+</span>
            </div>

            <h2 class="full-price">
              {{ $cart->price*$cart->quantity }}$
            </h2>

            <h2 class="price">
              {{ $cart->price}}$
            </h2>
          </section>
        </article>
    @endforeach



   
      <div class="w-100 d-flex-between-center">
          
            <div class="h1" style="float:clear">Total: <span>{{$total_price}}</span>$</div>
            <a href="{{ route('order_view') }}" class="btn btn-lg fs-4 rose">Checkout</a>
   
      </div>

</div>




















  {{-- <section>


                <!-- box -->
                <div class="col-lg-5 align-self-center ">
                  <div class="text-dark rounded-3">
                    <div class="card-head d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>
                      <x-application-logo class="text-gray-800 opacity-1" style="width: 35px" />
                    </div>
                    <div class="box-card d-flex-center-center">
                      <img class="box-card-img" src="{{ url('images/card.png') }}" />
                      <div class="box-card-2">
                        
                        <form id='checkout-form' method='post' action="{{ route('stripe.post') }}">   
                          @csrf             
                          <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
                          <br>
                          <div class="form-control payment-btn" id="card-element"></div>
                          <button id='pay-btn' onclick="createToken()"
                                  class="payment-btn border bg-dark text-light d-flex justify-content-center align-items-center" type="button"
                              >
                              <i class="fa-regular fa-credit-card fs-1 me-3"></i>  
                              Pay with Card
                          </button>
                        <form>
                        <span class="text-light p-2">Or</span>
                        
                        <a href="{{ route('make.payment') }}" class="payment-btn border bg-paypal text-light  d-flex justify-content-center align-items-center">
                          <i class="fa-brands fa-cc-paypal fs-1 me-3"></i>
                          Pay with PayPal
                        </a>
                      </div>

                    </div>
                    <div class="fs-4 mt-3">
                      Total Price : ${{$total_price}}
                    </div>

                  </div>

                </div>


  </section>
  
 <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">
  
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
  
    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {
   
            if(typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }
  
            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
  </script> --}}
@endsection
