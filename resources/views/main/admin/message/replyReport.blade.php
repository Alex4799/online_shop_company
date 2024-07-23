@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Reply Report</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#supplierList','report')}}">List</a></li>
              <li class="breadcrumb-item active">Reply</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Reply Report</h5>

              <form action="{{route('admin#replyReport')}}" method="post" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger py-3 alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <div class="py-2">
                    <label for="re_email" class="form-label">To</label>
                    <input type="email" value="{{$message->se_email}}" class="form-control" disabled>
                    <input type="hidden" name="email" value="{{$message->se_email}}">
                </div>

                <div class="py-2">
                    <label for="title" class="form-label">Title</label>
                    <input id="title" placeholder="Enter your title ...." class="form-control" type="title" name="title" :value="old('title')" >
                    @error('title')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="tinymce-editor" name="message" id="message" placeholder="Enter your message .....">{{old('message')}}</textarea>
                    @error('message')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <input type="hidden" name="reply_id" value="{{$message->id}}">
                <div class="">
                    <div class="py-2 d-flex justify-content-end flex-wrap">
                        <input type="submit" value="Send" class="btn btn-primary">
                    </div>
                </div>
            </form>

            </div>
          </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
