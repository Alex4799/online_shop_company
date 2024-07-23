@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>New Message</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#messageList','inbox')}}">List</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">New Message</h5>

              <form action="{{route('admin#sendAllMessage')}}" method="post" enctype="multipart/form-data">
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
                    <label for="se_email" class="form-label">From</label>
                    <input id="se_email" placeholder="Enter your email ...." class="form-control" type="name" name="se_email" value="{{old('se_email',Auth::user()->email)}}">
                    @error('se_email')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="role" class="form-label">To</label>
                    <select name="role" class="form-control">
                        <option value="">Choose Role</option>
                        <option value="user">User</option>
                        <option value="supplier">Supplier</option>
                    </select>
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
