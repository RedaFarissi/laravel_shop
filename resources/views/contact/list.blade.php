@extends('layout')

@section('title','All Message')

@section('head')

@endsection

@section('content')
<div class="container">
    <table class="table m-2 border">
        <tr class="alert-secondary p-2">
            <th> Subject  </th>
            <th> Email  </th>
            <th> Message  </th>
            <th> Response  </th>
        </tr>
        @foreach ($contacts as $contact )
        <tr>
            <td> {{ $contact->subject }} </td>
            <td> {{ $contact->email }} </td>
            <td> {{ $contact->message }} </td>
            <td>
                <form action="" method="POST">
                    @csrf
                    <textarea class="send_mail w-100">  </textarea>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
