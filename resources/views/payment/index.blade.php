@extends('layout')

@section('title','Payment')

@section('head')
 
  <style>
    
    .cadr-image{
      width: 80px;
      height: 80px;
    }
    .box-card{
      position: relative;
    }
    .white{
      color: white
    }
    .box-card-img{
      position: absolute;
      width: 100%;
      height: 350px;;
      opacity: 0.7;
    }
    
    /*payment */
    .payment-btn{
      background-color:var(--white);
      width:90%;
      margin: auto;
      height: 60px;
      font-size: 20px
    }
    .bg-paypal{
      background-color:#003087;
    }
    .margin-5p{
      margin: 5%;
    }
  </style>
@endsection

@section('content')
 


<div class="container mt-5 mb-5">
    <div class="d-flex-between-center row">
        <div class="col-lg-7">
            <div class="p-2">
              <h4>Shopping cart</h4>
              <div class=" pull-right"><span class="mr-1">Sort by:</span><span class="mr-1 font-weight-bold">Price</span><i class="fa fa-angle-down"></i></div>
            </div>
            <table class="table table-fuild">
                <tr >
                  <th class="cadr-image"> Image </th>
                  <th class="text-center"> name </th>
                  <th class="text-center"> quantity </th>
                  <th> price </th>
                  <th> price x quantity </th>
                </tr>
                @foreach($order_to_pays as $order_item)
                  <tr>
                    <td class="cadr-image">
                      <img class="rounded" src="{{ asset('storage/images/' . $order_item->product->image) }}">
                    </td>
                    <td class="font-weight-bold text-center pt-4">
                       {{(strlen($order_item->product->name) > 25) ? substr($order_item->product->name, 0, 25) . "..." : $order_item->product->name}}
                    </td>
                    <td class="font-weight-bold text-center pt-4">
                       {{$order_item->quantity}}
                    </td>
                    <td class="font-weight-bold text-center pt-4">
                        ${{$order_item->price}}
                    </td>
                    <td class="font-weight-bold text-center pt-4">
                      ${{$order_item->product->price * $order_item->quantity}}</i>
                    </td>
                  </tr>
                @endforeach
            </table>
        </div>
             
           
        <div class="col-lg-5 align-self-center">
          <div class="card-head d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 text-dark">Card details</h5>
            <x-application-logo class="text-gray-800 opacity-1" style="width: 35px" />
          </div>
          
           <hr>
            
              <div class="box-card-2 ">
                <form id='checkout-form' method='post' action="{{ route('stripe.post') }}">   
                  @csrf             
                  <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
                  <br>
                  <div class="form-control payment-btn mb-2 rounded pt-4" id="card-element"></div>
                  <button id='pay-btn' onclick="createToken()"
                          class="payment-btn border bg-dark text-light d-flex rounded justify-content-center align-items-center" type="button"
                      >
                      <i class="fa-regular fa-credit-card fs-1 me-3"></i>  
                      Pay with Card
                  </button>
                <form>
                <span class="margin-5p fs-4">Or</span>
                <a href="{{ route('make.payment') }}" class="payment-btn border rounded bg-paypal text-light  d-flex justify-content-center align-items-center">
                  <i class="fa-brands fa-cc-paypal fs-1 me-3"></i>
                  Pay with PayPal
                </a>
              </div>
            
            <div class="fs-4 mt-3 margin-5p">
              Total Price : ${{$total_price}}
            </div>
         
        </div>
        
    </div>
</div>






<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  var stripe = Stripe('{{ env('STRIPE_KEY') }}')
  var elements = stripe.elements();
  var cardElement = elements.create('card');
  cardElement.mount('#card-element');

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
</script>
@endsection
