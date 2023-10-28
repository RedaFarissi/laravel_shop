@extends('layout')

@section('title','Payment')

@section('head')
    <style>
        
        
    </style>
@endsection

@section('content')
<div class="container pt-5 mt-5">
  <div class="w-75 m-auto">
     <div class="d-flex p-3 alert-danger">
        <i class="fa-solid fa-exclamation mx-3" style="font-size:90px"></i>
        <div class="">
           <h2>Oops! Something went wrong. </h2>
           <p>While trying to reserve money from your account</p>
        </div>
      </div>
      <a class="w-100 btn btn-lg rounded mt-2 btn-warning text-light">Try again</a>
  </div>
</div>
@endsection
