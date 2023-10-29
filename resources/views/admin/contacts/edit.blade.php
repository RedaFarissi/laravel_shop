@extends('layouteAdmin')

@section('title','Edit Order')

@section('head')
    <link rel="stylesheet" href="{{ url('css/admin/products/edit.css') }}"> 
@endsection

@section('path')
    <a href="{{route('admin_home')}}">Admin</a> › <a href='{{ route('admin_contacts_list') }}'>Contact</a> > Edit
@endsection

@section('size',"aside-list")

@section('content')
<div id="product-box" class="content-list">
 
    <div class="p-4">
        <form action="{{ route('admin_contact_edit' , [$contact->id]) }}" method="POST">
            @csrf 
            @method('PUT')
          
                <h5 class="font-weight-3 mb-5">Edit Order</h5>
                <table class='table-create'>
                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Order ID :</b> </td>
                        <td class="td"> 
                            <select id="user_id" name="user_id" class="input-select mt-2 mb-2">
                                {{-- <option value="{{$contact->id}}"> {{$contact->name}} </option> --}}
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}"> {{$user->name}} </option>
                                @endforeach
                            </select> 
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('user_id')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Email :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$contact->email}}"
                                name="email" class="input-number mt-2 mb-2" 
                                id='email' autofocus
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('email')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width td"> <b class="d-block mt-2 mb-2">Subject :</b> </td>
                        <td class="td"> 
                            <input 
                                type="text" value="{{$contact->subject}}"
                                name="subject" class="input-number mt-2 mb-2" 
                                id='subject' autofocus
                            />
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('subject')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>

                    <tr class="mb-2 position-r" style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="lavel-create-width position-a td" style="top:0">
                            <b class="d-block mt-2 mb-2" >Message :</b>
                        </td>
                        <td class="td"><textarea name="message" class="input-textarea mt-2 mb-2" id="message" cols="30" rows="10">{{$contact->message}}</textarea></td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('message')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>  
                    
                    <tr style="border-top:0.1px solid rgba(255 255 255/20%);">
                        <td class="td" colspan="2"> 
                            <input 
                                type="checkbox" name="answer" id="answer" 
                                value="{{$contact->answer}}" class="mt-3 mb-2" @checked($contact->answer)
                            /> &nbsp;
                            <b class="mt-3 mb-2">answer </b>
                        </td>
                    </tr>
                    <tr>
                       <td class="td" colspan="2">  
                            @error('answer')   
                            <ul class="mt-2"><li class="text-danger"> {{$message}} </li></ul>               
                            @enderror
                        </td> 
                    </tr>  
                </table>
                <div class="alert bg-dark d-flex-between-center alert-save-item mt-3">
                    <div class="alert-save-item-div">
                        <button type="submit" value="true" name="submit" class="btn bg-blue white" >Save</button>
                        <button type="submit" value="false" name="submit" class="btn bg-blue white" >Save and add another</button>
                    </div>
                    <a href="{{ route('admin_contact_delete',[$contact->id]) }}" class="btn btn-danger" >Delete</a>
                </div>
           
        </form>
    </div>
</div>
<script src="{{ url('js/admin-aside-fixed-aside.js') }}"></script>
@endsection