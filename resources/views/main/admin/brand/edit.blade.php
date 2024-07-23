@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Edit Brand</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#brandList')}}">List</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Edit Brand</h5>

              <form action="{{route('admin#updateBrand')}}" method="post" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Image</label>
                    <div class="row">
                        <div class="col-md-6 py-2">
                            <img src="{{asset('storage/brand/'.$brand->image)}}" alt="Profile" class="w-100" id="image">
                        </div>
                        <div class="col-md-6 py-2">
                            <input type="file" name="image" class="form-control" id="input_image">
                            @error('image')
                                <small class=" text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" value="{{$brand->name}}" placeholder="Enter your name ...." class="form-control" type="name" name="name" :value="old('name')" required autofocus>
                    @error('name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <input type="hidden" name="id" value="{{$brand->id}}">
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
    <script>
        $(document).ready(function(){
            $('#input_image').change(function(){
                document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);
            })
        })
    </script>
@endsection
