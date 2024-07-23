@extends('mails.layout')
@section('title')
    {{$mailData['title']}}
@endsection
@section('content')
    <div class="p-3">
        <h3>{{$mailData['title']}}</h3>
        <p>{!!$mailData['body']!!}</p>
      </div>
@endsection
