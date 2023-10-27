@extends('layout')

@section('title','Product Create')
@section('head')
<style>
  #first_name , #last_name , #email , #address , #postal_code , #city { 
      background-color:#e9e9e9; width:99%; border:none; border-radius: 4px; 
      height:50px; margin-bottom:9px; outline:0; padding:4px; padding:9px;
  }
  .shadow{
    box-shadow: 3px 3px 7px rgba(0 0 0/40%)
  }
 
  @media only screen and (max-width: 850px){
      .col-md-7{ width:100%; padding: 0}
      .btn-submit{ margin-bottom:90px;}
      #first_name , #last_name , #email , #address , #postal_code , #city { 
        background-color:#e9e9e9; width:100%; padding:0px;
      }
  }
</style>
@endsection

@section('content')
<section>
  <div class="container-fluid pt-4">
      <div class="row ">
          <div class="m-auto col-md-7 shadow pb-5">
              <h1 class="mt-3">Your order</h1>
              <b>Total: ${{ $total_price }}</b>
              <hr class="mt-1 mb-5" />
          
            <form action="{{ route('order_store') }}" method="POST">
              @csrf
              <div class="row mx-4">
                  <div class="col-md-6">
                      <div class="form-outline">
                          <input type="text" name="first_name" id='first_name'  autofocus required/>
                          <label class="form-label" value="{{ old('first_name') }}" for="id_first_name"><b>First</b></label>
                      </div>
                  </div>
                  <div class="col-md-6 mt-2 mt-sm-0">
                      <div class="form-outline">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" id='last_name'  required/>
                          <label class="form-label" for="form2"><b>Last</b></label>
                      </div>
                  </div>
              </div>
          
              <div class="row  mt-3 mx-4">
                  <div class="col-12">
                      <div class="form-outline">
                          <input type="email" name="email" id="email" value="{{ old('email') }}"  required/>
                          <label class="form-label" for="form5"><b>Email</b></label>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="form-outline">
                          <input type="text" name="address" value="{{ old('address') }}" id="address" required/> 
                          <label class="form-label" for="form5"><b>Address</b></label>
                      </div>
                  </div>
                 
                  <div class="col-12">
                      <div class="form-outline">
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" id="postal_code"  required/> 
                        <label class="form-label" for="form5"><b>Postal code</b></label>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="form-outline">
                        <input type="text" name="city" id="city" value="{{ old('city') }}" required/> 
                        <label class="form-label" for="form5"><b>City</b></label>
                      </div>
                  </div>  
                  <div class="col-12 mt-3">
                      <button type="submit" class="btn-submit w-100 btn btn-lg fs-4" style='background-color:#ffd3b4;' >
                          Create Order
                      </button>
                  </div>
                              
              </div>
            </form>
          </div>
      </div>
  </div>
</section>
          
@endsection