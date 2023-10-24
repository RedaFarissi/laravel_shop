@extends('layout')

@section('title','Product Create')

@section('head')
    <style>
      .card-payment{
        border:9px solid var(--rose)
      }
      
      @media (min-width: 1025px) {
        .h-custom {  height: 100vh !important;  }
      }
      @media (max-width: 600px) {
        .card-payment{ border:none;}
      }
  </style>
@endsection

@section('content')
  <section class="h-100 h-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100" >
        <div class="col">
          <div class="card rounded" style="box-shadow:3px 3px 20px rgba(0 0 0/25%);">
            <div class="card-body p-4">

              <div class="row">

                <div class="col-lg-7">
                  <h5 class="mb-3"><a href="{{ url()->previous() }}" class="text-body">
                    <i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a>
                  </h5>
                  <hr/>

                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                      <p class="mb-1">Shopping cart</p>
                      <p class="mb-0">You have 4 items in your cart</p>
                    </div>
                    <div>
                      <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                          class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                    </div>
                  </div>


                  @foreach ($carts as $cart) 
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="d-flex flex-row align-items-center">
                            <a href="{{ route('products.show', [$cart->id]) }}">
                              <img 
                                src="{{ asset('storage/images/' . $cart->image) }}"
                                class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                            </a>
                            <div class="ms-3">
                              <h5> {{(strlen($cart->name)>20)?substr($cart->name, 0, 20)."...":$cart->name}} </h5>
                              <p class="small mb-0">{{ substr($cart->description, 0, 26) }}</p>
                            </div>
                          </div>
                          <div class="d-flex flex-row align-items-center">
                            <div style="width: 50px;">
                              <h5 class="fw-normal mb-0"> {{ $cart->quantity }}</h5>
                            </div>
                            <div style="width: 80px;">
                              <h5 class="mb-0"> ${{ $cart->price*$cart->quantity }}</h5>
                            </div>
                            <a href="#!" style="color: #cecece;">
                              <i class="fas fa-trash-alt text-danger"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>




                {{-- box --}}
                <div class="col-lg-5">
                  <div class="card card-payment text-dark rounded-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Card details</h5>
                        <x-application-logo class="text-gray-800" style="width: 35px" />
                      </div>

                      <p class="small mb-2">Card type</p>
                      <a href="#!" type="submit" class="text-dark"><i
                          class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                      <a href="#!" type="submit" class="text-dark"><i
                          class="fab fa-cc-visa fa-2x me-2"></i></a>
                      <a href="#!" type="submit" class="text-dark"><i
                          class="fab fa-cc-amex fa-2x me-2"></i></a>
                      <a href="#!" type="submit" class="text-dark"><i class="fab fa-cc-paypal fa-2x"></i></a>

                      <form class="mt-4">
                        <div class="form-outline form-white mb-4">
                          <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                            placeholder="Cardholder's Name" />
                          <label class="form-label" for="typeName">Cardholder's Name</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                          <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                            placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                          <label class="form-label" for="typeText">Card Number</label>
                        </div>

                        <div class="row mb-4">
                          <div class="col-md-6">
                            <div class="form-outline form-white">
                              <input type="text" id="typeExp" class="form-control form-control-lg"
                                placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                              <label class="form-label" for="typeExp">Expiration</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-outline form-white">
                              <input type="password" id="typeText" class="form-control form-control-lg"
                                placeholder=";" size="1" minlength="3" maxlength="3" />
                              <label class="form-label" for="typeText">Cvv</label>
                            </div>
                          </div>
                        </div>

                      </form>

                      <hr class="my-4">

                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2">$4798.00</p>
                      </div>

                      <div class="d-flex justify-content-between">
                        <p class="mb-2">Shipping</p>
                        <p class="mb-2">$20.00</p>
                      </div>

                      <div class="d-flex justify-content-between mb-4">
                        <p class="mb-2">Total(Incl. taxes)</p>
                        <p class="mb-2">$4818.00</p>
                      </div>

                      <button type="button" class="btn rose btn-block btn-md">
                        <div class="d-flex justify-content-between gap-1">
                          <span>$4818.00</span> 
                          <span> Checkout </span>
                        </div>
                      </button>

                    </div>
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
