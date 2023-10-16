@extends('layouteAdmin')

@section('title','Add User')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/users/create.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_users_list') }}'>User</a> > Create
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
    <div class="p-4">
        <form action="{{ route('admin_user_create_store') }}" method="POST" id="delete_all_form">
            @csrf 
            <div class="mb-5 mb-4" >
            <h5 class="font-weight-3 mb-5">Add User</h5>
            <table class='table-create'> 

                <tr class="mb-2">
                    <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Role :</b></td>
                    <td> 
                        <select name="role" id="role" class="input-select ps-2 pe-5">
                            <option class="user"> user </option>
                            <option class="user"> admin </option>
                        </select>
                    </td>
                </tr>
                

                <tr class="mb-2">
                    <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Name :</b></td>
                    <td> 
                        <input 
                            type="text" value="{{ old('name')}}" name="name" 
                            class="input-text mt-2 mb-2"  id='name' autofocus
                        />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">  
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />
                    </td> 
                </tr>       

                <tr class="mb-2">
                    <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Email :</b></td>
                    <td> 
                        <input 
                            type="email" name="email" 
                            class="input-text mt-2 mb-2" id='email' 
                        />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">  
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />
                    </td> 
                </tr>         
                
                <tr class="mb-2">
                    <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Password :</b></td>
                    <td> 
                        <input 
                            type="password"   id="password"
                            name="password" class="input-text mt-2 mb-2" 
                         />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">  
                         @error('password')   
                         <ul class="mt-2">
                            <li class="text-danger"> {{$message}} </li>
                         </ul>              
                         @enderror
                     </td> 
                </tr>

                <tr class="mb-2">
                    <td class="lavel-create-width td"><b class="d-block mt-2 mb-2">Password verifie :</b></td>
                    <td> 
                        <input 
                            type="password"  name="password_confirmation" 
                            class="input-text mt-2 mb-2"  id="password_confirmation"
                        /></td>
                </tr>
                <tr >
                   <td colspan="2">  
                        @error('password_confirmation')   
                         <ul class="mt-2">
                            <li class="text-danger"> {{$message}} </li>
                         </ul>                
                        @enderror
                    </td> 
                </tr>
            </table>
            <hr/>
                <div class="alert-save-item alert bg-dark">
                    <button type="submit" value="true" name="submit" class="btn bg-blue white" >Save</button>
                    <button type="submit" value="false" name="submit" class="btn bg-blue white" >Save and add another</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>

@endsection