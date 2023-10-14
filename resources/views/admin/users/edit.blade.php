@extends('layouteAdmin')

@section('title','Edit User')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/users/edit.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_users_list') }}'>User</a> > Edit
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
    <div class="px-5 mb-5">
        <h5 class="font-weight-3 mb-5">Edit user</h5>
        <form action="{{ route('profile.update' , $user->id , true) }}" method="POST">
            @csrf 
            @method('patch')
            <div class="mb-4" >
                <table class='table-create'>
                    <tr><td colspan="2"><h4 class="mb-3 my-4">Profile Information </h4></td></tr>
                    <tr><td colspan="2"><p>Update your account's profile information and email address.</p></td></tr>
                    <tr class="mb-2">
                        <td  class="lavel-create-width"><b class="d-block mt-2 mb-2">Name :</b></td>
                        <td> <input type="text" value="{{$user->name}}" id="name" name="name" class="input-text mt-2 mb-2" autofocus/></td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('name')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td  class="lavel-create-width"><b class="d-block mt-2 mb-2">Email :</b></td>
                        <td> <input type="email" value="{{$user->email}}" id="email" name="email" class="input-text mt-2 mb-2"/></td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('email')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td  class="lavel-create-width"><b class="d-block mt-2 mb-2">Password :</b></td>
                        <td> {{$user->password}} </td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('password')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>
                </table>
                <button type="submit" name="submit" value="true" class="m-2 mt-3 btn bg-blue white" >Save</button>
            </div>
        </form>
        


        <hr class="w-75 ms-3"/>
        {{-- UPDATE PASSWORD --}}
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            
            <div class="mb-4">
                <table>
                    <tr><td colspan="2"><h4 class="mb-3 my-4">Update Password </h4></td></tr>
                    <tr><td colspan="2"><p>Ensure your account is using a long, random password to stay secure.</p></td></tr>
                    <tr>
                        <td  class="lavel-create-width"><b class="d-block mt-2 mb-2">Current Password :</b></td>
                        <td> 
                            <input type="password" id="current_password" name="current_password" class="input-text mt-2" />
                        </td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('current_password')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td  class="lavel-create-width"><b class="d-block mt-2 mb-2">New Password :</b></td>
                        <td> 
                            <input type="password" id="password" name="password" class="input-text mt-2" />
                        </td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('password')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2">
                        <td  class="lavel-create-width">
                            <b class="d-block mt-2 mb-2">Confirm Password :</b>
                        </td>
                        <td> 
                            <input 
                                type="password" id="password_confirmation" 
                                name="password_confirmation" class="input-text mt-2" 
                            />
                        </td>
                    </tr>
                    <tr>
                       <td colspan="2">  
                            @error('password_confirmation')   
                             <div class="alert alert-danger mt-2">
                                {{$message}} 
                             </div>                
                            @enderror
                        </td> 
                    </tr>
                </table>
                <button type="submit" name="submit" class="m-2 mt-3 btn bg-blue white" >Save</button>
            </div>
        </form> 
        
        <hr class="w-75 ms-3 mb-4"/>

        <div>
            <tr><td colspan="2"><h4 class="mb-3 my-4">Delete account </h4></td></tr>
            <p class="w-75">
                Once your account is deleted, all of its resources and data will be permanently deleted. 
                Before deleting your account, please download any data or 
                information that you wish to retain.
            </p>


            <div class="alert bg-dark d-flex-between-center m-2 mb-5 alert-save-item">
                <a href="{{ route('admin_user_delete' , [$user->id]) }}" class="btn btn-danger" >Delete</a>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
@endsection