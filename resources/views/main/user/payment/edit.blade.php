@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Edit Payment</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user#paymentList')}}">List</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Edit Payment</h5>

              <form action="{{route('user#paymentUpdate')}}" method="post" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Title</label>
                    <input id="name" placeholder="Eg. KBZ pay..." class="form-control" type="name" name="name" value="{{old('name',$payment->name)}}" >
                    @error('name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="number" class="form-label">Number</label>
                    <input id="number" placeholder="Enter your number ...." class="form-control" type="text" name="number" value="{{old('number',$payment->number)}}" >
                    @error('number')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="user_name" class="form-label">User Name</label>
                    <input id="user_name" placeholder="Enter your user_name ...." class="form-control" type="text" name="user_name" value="{{old('user_name',$payment->user_name)}}" >
                    @error('user_name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <input type="hidden" name="id" value="{{$payment->id}}">

                <div class="">
                    <div class="py-2 d-flex justify-content-end flex-wrap">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </div>
            </form>

            </div>
          </div>
    </div>
@endsection
@section('script')

@endsection
