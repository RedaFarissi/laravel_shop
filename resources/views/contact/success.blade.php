@extends('layout')

@section('title','MyShop')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        .box-success { text-align: center; padding: 40px 0;  }
        .heading-h1 { color: #88B04B; font-family: "Nunito Sans", "Helvetica Neue", sans-serif; font-weight: 900; font-size: 40px; margin-bottom: 10px; }
        .paragraph-p { color: #404F5E; font-family: "Nunito Sans", "Helvetica Neue", sans-serif; font-size:20px; margin: 0; }
        .checkmark { color: #9ABC66; font-size: 100px; line-height: 200px; margin-left:-15px;}
        .card {  background: #EBF0F5;;  padding: 60px;  border-radius: 4px;  box-shadow: 0 2px 3px #C8D0D8;  display: inline-block;  margin: 0 auto; }
      </style>
@endsection



@section('content')
<div class="box-success">
    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1  class="heading-h1">Success</h1>
        <p class="paragraph-p">We received your purchase request;<br/> we'll be in touch shortly!</p>
    </div>
</div>
@endsection
