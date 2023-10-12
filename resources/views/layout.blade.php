<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('css/base.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('head')
    </head>
    <body>
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
       
        <button class="rose btn-fa btn rounded-circle d-flex justify-content-center align-items-center" title='Just for admin' onmouseover="fa_lock_over()" onmouseout="fa_lock_out()">
          <i class="fa-solid fa-lock fs-5"></i>
        </button>
      </div>
      
      <header class='d-flex justify-content-around align-items-center header'>
        <div class='mt-2 hedaer-left'>
            <a href="{{ route('home') }}"><h5 id="collection">MY SHOP</h5></a>
        </div>
    
        <div class='row hedaer-center'>
            <a href="{{ route('home') }}" class='col-3 text-center text-dark hedaer-center-item'> Home </a>
            <a href="{{ route('products.index') }}" class='col-3 text-center text-dark hedaer-center-item'> Products </a>
            <a href="{{ route('about') }}" class='col-3 text-center text-dark hedaer-center-item'> About </a>
            <a href="{{ route('contact') }}" href="contact" class='col-3 text-center text-dark hedaer-center-item'> Contact </a>
        </div>

        <div class='header-right'>
              <a href="" class="hedaer-right-btn btn btn-outline-danger" title="Logout"> 
                <i class="fa-solid fa-right-from-bracket"></i> 
              </a> 
              <a href="{{ route('products.create') }}" class="hedaer-right-btn btn border border-1 border-dark" title='Create Post'>
                <i class="fa-solid fa-plus fs-5 w-100 text-center"></i>
              </a> 
              <a href="{{ route('login') }}" class="hedaer-right-btn btn btn-outline-success" title='Login'> 
                <i class="fa-solid fa-right-to-bracket"></i> 
              </a>
              @if (Route::has('register'))
              <a href="" class='hedaer-right-btn btn border border-1 border-dark' title='Register'>
                <i class="fa-solid fa-user-plus"></i>
              </a>
              @endif
              <a href="" class="hedaer-right-btn btn border border-1 border-dark position-relative" title='cart'> 
                <i class="fa-solid fa-cart-shopping"></i> 
                <div class='badge rounded-circle text-dark position-absolute' style='right:-7px;top:-7px;'>  </div>
              </a>
        </div>
      </header> 
      
        @yield('content')
       

        <script src="{{ url('js/bootstrap.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   
        <script>
          function fa_lock_over(){
            document.getElementById("is_superuser_box").style.display = "block"
          }
          function fa_lock_out(){
            document.getElementById("is_superuser_box").style.display = "none"
          }
          window.addEventListener("scroll", () => { 
              var sidebar = document.getElementById("aside")
              var container_home = document.getElementById("container-home")
              var product_box = document.getElementById("product-box")

              //getBoundingClientRect is function to get distance between top of page and element
              if(container_home.getBoundingClientRect().top <= 0 && window.innerWidth >= 1024){
                sidebar.style = "position:fixed;top:0px;padding-top:0px;z-index:99;height:100vh;";
                container_home.style = "position:relative"
                product_box.style = "width:calc(100% - 236px);position:absolute;right:1px;"
              }else{
                sidebar.style = "position:static;padding-top:0px"
                product_box.style = "position:static;"    
              }
          }); 
        </script>
    </body>% - 
    
</html>