@extends('mails.layout')
@section('title')
    {{$mailData['title']}}
@endsection
@section('content')
    <h3>{{$mailData['title']}}</h3>
    <p>{{$mailData['body']}}</p>
@endsection
