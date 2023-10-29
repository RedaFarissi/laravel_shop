@php
  $cart = session('cart',0);
@endphp

<!DOCTYPE html>
<html>
    <head>
        <!--  @ vite => x-application-logo  -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
      @auth
        @if(Auth::user()->role === "super admin" || Auth::user()->role === "admin")
          <div class="is_superuser position-fixed text-light">
            <div id='is_superuser_box' onmouseover="fa_lock_over()" onmouseout="fa_lock_out()">
              <a href="{{ route('contact_list') }}" title='All Message From User' class="rose btn-fa btn rounded-circle d-flex justify-content-center align-items-center">
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
        @endif
      @endauth

      <header onclick="remove_profile()" class='d-flex justify-content-around align-items-center header'>
        <div class='mt-2 hedaer-left'>
            <a href="{{ route('home') }}">
              <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <div class='row hedaer-center d-flex-center'>
          <a href="{{ route('dashboard') }}" class='col-3 text-center text-dark hedaer-center-item'> Dashboard </a>
          <a href="{{ route('products.index') }}" class='col-3 text-center text-dark hedaer-center-item'> Products </a>
          <a href="{{ route('about') }}" class='col-3 text-center text-dark hedaer-center-item'> About </a>
          <a href="{{ route('contact_create') }}" class='col-3 text-center text-dark hedaer-center-item'> Contact </a>
        </div>

        <div class='header-right d-flex align-items-center'>
              <a href="{{ route('cart_view') }}" class="hedaer-right-btn btn border border-1 border-dark position-relative" title='Cart'>
                <i class="fa-solid fa-cart-shopping"></i>
                <div class='badge rounded-circle text-light @php echo (is_array($cart))?"bg-primary":"text-light bg-secondary" ;  @endphp position-absolute' style='left:-9px;top:-8px;'> 
                  @php echo (is_array($cart))?count($cart):$cart;  @endphp
                </div>
              </a>
              
              @auth
                <a href="{{ route('products.create') }}" class="hedaer-right-btn btn border border-1 border-dark" title='Create Post'>
                  <i class="fa-solid fa-plus fs-5 w-100 text-center"></i>
                </a>
                <span href="{{ route('profile.update') }}" class="hedaer-right-btn position-relative">
                  <i class="fa-solid fa-circle-user cursor-pointer ms-2" style="font-size:53px" id="profile_to_click"></i>

                  <div id="profile-drop" class="pb-4" style="display :none">
                    <div class="create-style-icon"></div>
                    <a href='{{ route('profile.edit') }}'>
                      <div class="profile-drop-btn d-flex align-items-center rounded p-1">
                        <i class="fa-solid fa-circle-user fs-4"></i>
                        <b class="ms-2">{{ Auth::user()->name }}</b>
                      </div>
                    </a>
                    <hr/>
                    <div class="profile-drop-btn d-flex align-items-center rounded p-1">
                      <i class="fa-solid text-danger fa-right-from-bracket ms-1 me-3"></i>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="outline:none;border:none">Logout</button>
                      </form>
                    </div>
                  </div>
                </span>
              @else
                <a href="{{ route('login') }}" class="hedaer-right-btn btn btn-outline-success" title='Login'>
                  <i class="fa-solid fa-right-to-bracket"></i>
                </a>
                @if(Route::has('register'))
                  <a href="{{ route('register') }}" class='hedaer-right-btn btn border border-1 border-dark' title='Register'>
                    <i class="fa-solid fa-user-plus"></i>
                  </a>
                @endif
              @endauth
        </div>
      </header>
      <div onclick="remove_profile()">
        @yield('content')
      </div>

      
        <script src="{{ url('js/bootstrap.js') }}"></script>
        <script src="{{ url('js/home-index.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
          window.document.getElementById('profile_to_click').addEventListener("click",(event)=>{
            ( window.getComputedStyle(document.getElementById("profile-drop")).getPropertyValue('display')  === "none" )? document.getElementById("profile-drop").style = "display:block" :document.getElementById("profile-drop").style= "display:none";
            event.stopPropagation()
          })

          function fa_lock_over(){
            document.getElementById("is_superuser_box").style.display = "block"
          }

          function fa_lock_out(){
            document.getElementById("is_superuser_box").style.display = "none"
          }

          function remove_profile(){
            document.getElementById("profile-drop").style= "display:none";
          }
        </script>
    </body>

</html>
