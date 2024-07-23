@extends('mails.layout')
@section('title')
    {{$mailData['title']}}
@endsection
@section('content')
    <div class="p-3">
        <h3>{{$mailData['title']}}</h3>
        <p>{{$mailData['body']}}</p>
        <div>
            <p>{{$mailData['info']}}</p>
        </div>
        <div class="d-flex justify-content-center p-3">
            OTP
        </div>
        <div class="d-flex justify-content-center p-3">
            <button class="btn-primary">{{$mailData['otp']}}</button>
        </div>
      </div>
@endsection
