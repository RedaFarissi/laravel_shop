<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ url('css/admin/home.css') }}">
        @yield('head')
        <style>  *{ font-size:99%}  </style>
    </head>
    <body>
    
        <nav class="header px-5 container-fluid">
              <a class="header-logo navbar-brand h6 font-weight-4" href="{{ route('admin_home') }}">
                 Administration 
              </a>
              <div class="d-flex header-link align-items-center">
                WELCOME, <b><b>Name</b></b>. <a href='{{route('home')}}' title='Home'>VIEW SITE</a> / <a href='#' title='change password'>CHANGE PASSWORD</a> / 
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="bg-blue white font-weight-3 under-line" style=";outline:none;border:none">Logout</button> 
                </form>
              </div>
        </nav>


        <div class="alert-path alert border-radius-none p-2" style="background-color:var(--blueDark);">
            @yield('path')
        </div>


        <div class="container-fluid p-0">
          <section id="container-home" class="d-flex flex-wrap">
            <aside id='aside' class="@yield('size')">
              <div class="mt-4">
                 <table class="table table-aside mb-5">
                  <tr><h6 class="table-heading p-2"> AUTHENTICATION AND AUTHORIZATION </h6></tr>
                  <tr>
                      <td class="w-75"><a href='{{ route('admin_users_list') }}' class="link-blue">Users</a></td>
                      <td>
                        <a href='{{ route('admin_user_create_views') }}' class="link-blue">
                          <div class="d-flex-center-center"> 
                              <div class="fa-solid fa-plus" style="color: var(--green);"></div>&nbsp; <div>Add</div>
                          </div>
                        </a>
                      </td>
                      <td  class="aside-change-icon"> 
                        <a href='{{ route('admin_users_list') }}' class="link-blue">
                          <div class="d-flex-center-center"> 
                             <div class="fa-solid fa-pen text-warning"></div> &nbsp;<div>Change</div>
                          </div>
                        </a>
                      </td>
                  </tr>
                 </table>
               
                 <table class="table table-aside mb-5">
                  <tr><h6 class="table-heading p-2"> AUTHENTICATION AND AUTHORIZATION </h6></tr>
                  <tr>
                      <td class="w-75"><a href='{{ route('admin_products_list') }}' class="link-blue">Products</a></td>
                      <td>
                        <a href='{{ route('admin_product_create_views') }}' class="link-blue">
                          <div class="d-flex-center-center"> 
                              <div class="fa-solid fa-plus" style="color: var(--green);"></div>&nbsp; <div>Add</div>
                          </div>
                        </a>  
                      </td>
                      <td class="aside-change-icon"> 
                        <a href='{{ route('admin_products_list') }}' class="link-blue">
                          <div class="d-flex-center-center"> 
                            <div class="fa-solid fa-pen text-warning"></div> &nbsp;<div>Change</div>
                          </div>
                        </a>  
                      </td>
                  </tr>
                  <tr>
                    <td class="w-75"><a href='{{ route('admin_categories_list') }}' class="link-blue">Categories</a></td>
                    <td>
                      <a href='{{ route('admin_category_create_views') }}' class="link-blue">
                        <div class="d-flex-center-center">
                          <div class="fa-solid fa-plus" style="color: var(--green);"></div>&nbsp; <div>Add</div>
                        </div>
                      </a>  
                    </td>
                    <td class="aside-change-icon"> 
                      <a href='{{ route('admin_categories_list') }}' class="link-blue">
                        <div class="d-flex-center-center"> 
                           <div class="fa-solid fa-pen text-warning"></div> &nbsp;<div>Change</div>
                        </div>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td class="w-75"><a href='{{ route('admin_sizes_list') }}' class="link-blue">Sizes</a></td>
                    <td>
                      <a href='{{ route('admin_size_create_views') }}' class="link-blue">
                        <div class="d-flex-center-center">
                          <div class="fa-solid fa-plus" style="color: var(--green);"></div>&nbsp; <div>Add</div>
                        </div>
                      </a>  
                    </td>
                    <td class="aside-change-icon"> 
                      <a href='{{ route('admin_sizes_list') }}' class="link-blue">
                        <div class="d-flex-center-center"> 
                           <div class="fa-solid fa-pen text-warning"></div> &nbsp;<div>Change</div>
                        </div>
                      </a>
                    </td>
                  </tr>
                </table>
              </div>
            </aside>
          
            @yield('content')
          
          </section>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   
        <script src="{{ url('js/bootstrap.js') }}"></script>
        {{-- <script>
          document.body.style = "height:200vh"
        </script> --}}
    </body>
</html>