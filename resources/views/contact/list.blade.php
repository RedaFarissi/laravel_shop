@extends('layout')

@section('title','All Message')

@section('head')

@endsection

@section('content')
<table class="table">
    <tr>
        <th> Subject  <th>
        <th> Email  <th>
        <th> Message  <th>
    </tr>
    @foreach ($contacts as $contact )
        <tr>
            <td> {{ $contact->subject }} <td>
            <td> {{ $contact->email }} <td>
            <td class="w-50"> {{ $contact->message }} <td>
        </tr>
    @endforeach
</table>
@endsection
