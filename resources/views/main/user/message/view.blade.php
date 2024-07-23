@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>View Message</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user#messageList')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">View Message</h5>
              @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <div class="py-2">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 py-2">
                            <div>
                                <h6 class="py-2">From - {{$message->se_email}}</h6>
                                <h6 class="py-2">To - {{$message->re_email}}</h6>
                                <h6 class="py-2">Title - {{$message->title}}</h6>
                                <p>{!!$message->message!!}</p>

                            </div>
                            @if ($message->se_email!=Auth::user()->email)
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('user#messageAddPage',$message->id)}}" class="btn btn-primary">Reply</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @foreach ($replyMessage as $item)
                        <div class="py-2">
                            <div class="row card">
                                <div class="col-md-8 offset-md-2 py-2">
                                    <div class="d-flex justify-content-end">
                                        <h6>{{$item->created_at}}</h6>
                                    </div>
                                    <div>
                                        <h6 class="py-2">From - {{$item->se_email}}</h6>
                                        <h6 class="py-2">To - {{$item->re_email}}</h6>
                                        <h6 class="py-2">Title - {{$item->title}}</h6>
                                        <p>{!!$item->message!!}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
          </div>
    </div>
@endsection
@section('script')

@endsection
