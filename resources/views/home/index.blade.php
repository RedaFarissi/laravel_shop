@extends('layout')

@section('title','MyShop')

@section('head')
    <link rel="stylesheet" href="{{ url('css/home/index.css') }}">
@endsection

@section('content')
<section id="section">
    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner h-100">
          <div class="carousel-item h-100 active">
            <img src="{{ asset('images/banner-1.jpg') }}" class='w-100 h-100' />
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
          <div class="carousel-item h-100">
            <img src="{{ asset('images/banner-2.jpg') }}" class='w-100 h-100'/>
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p>.</p>
            </div>
          </div>
          <div class="carousel-item h-100">
            <img src="{{ asset('images/banner-3.jpg') }}" class='w-100 h-100'/>
            <div class="carousel-caption d-none d-md-block">
              <h5></h5>
              <p></p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
  </section>

  <section id="container-home">

    <aside class="aside mt-3" id="aside">
        <h5>Categories</h5>
        <div class="list-group">
            <a href="{{ route('home') }}" class="list-group-item rounded border-0 @if(! isset($category_id) ) rose @endif">
                <b>All</b>
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('home_category_by_id' , [$category->id]) }}" class="list-group-item rounded border-0 @if(isset($category_id) && $category_id == $category->id ) rose @endif">
                  <b>{{ $category->name }}</b>
                </a>
            @endforeach
        </div>
    </aside>




    <div class='main_products pt-3' id="product-box">

        <div class="row align-items-center">
            @foreach ($products as $product )

              <div class="col-md-4 p-0 position-relative h-100" >
                  <div  class='cadre-product mb-3 h-100' style="width:95%;">
                    <div class="card w-100 h-100">

                      <a href="{{ route('products.show', [$product->id]) }}" >
                        <img class='card-img-top w-100 object-fit-cover' src="{{ asset('storage/images/' . $product->image) }}" />
                      </a>

                      <div class="card-body" style>
                        <div>
                          <a href="{{ route('products.show', [$product->id]) }}" class="@if(count($product->sizes)<=0)d-block pb-2 @endif">
                            <b>{{ (strlen($product->name) > 30) ? substr($product->name, 0, 30) . "..." : $product->name }}</b>
                          </a>
                        </div>
                        <div class="mt-2 d-flex justify-content-between me-1 align-items-center @if(count($product->sizes)<=0) pb-2 @endif">
                          <div class="d-flex justify-content-between">
                            <b>Price : {{ $product->price }}$ </b>
                          </div>
                          <div class='like rounded border'>
                            <a
                                class='add-like-product Like btn'>
                                <i class="fa-sharp fa-solid fa-thumbs-up like-i text-primary"></i>
                                <b class='total-like'> 0 </b>
                            </a>
                          </div>
                        </div>

                        <div class='mt-3'>
                          @if(count($product->sizes)>0)
                            <p class="card-text d-flex align-items-center flex-wrap"><b>Sizes :</b> &nbsp;
                              @foreach ($product->sizes as $size)
                              <span class="badge bg-dark me-1">{{ $size->name }}</span>
                              @endforeach
                            </p>
                          @endif
                        </div>
                      </div>
                    </div>


                  </div>
              </div>
            @endforeach
        </div>
    </div>
  </section>
 @endsection
