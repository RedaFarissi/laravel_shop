@extends('layouteAdmin')

@section('title','Admin Home')

@section('path')
    Site administration
@endsection


@section('size',"aside-index")


@section('content')
<div class="recent_tactions" style="">
    <div class="p-4">
        <div class="action-table row p-2 justify-content-center">
            <h6 class="font-weight-4">Recent actions</h6>
            <p class="font-weight-2">My actions</p>
        </div>
    </div>
</div>
    
@endsection