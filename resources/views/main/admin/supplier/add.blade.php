@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Add Supplier</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#supplierList')}}">List</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Add Supplier</h5>

              <form action="{{route('admin#addSupplier')}}" method="post" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Name</label>
                    <input id="name" placeholder="Enter your name ...." class="form-control" type="name" name="name" :value="old('name')" >
                    @error('name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" placeholder="Enter your email ...." class="form-control" type="email" name="email" :value="old('email')" >
                    @error('email')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" placeholder="Enter your phone ...." class="form-control" type="phone" name="phone" :value="old('phone')" >
                    @error('phone')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="address" class="form-label">address</label>
                    <input id="address" placeholder="Enter your address ...." class="form-control" type="address" name="address" :value="old('address')" >
                    @error('address')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="tinymce-editor" name="description" id="description" placeholder="Enter your description .....">{{old('description')}}</textarea>
                    @error('description')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="">
                    <div class="py-2 d-flex justify-content-end flex-wrap">
                        <input type="submit" value="Add" class="btn btn-primary">
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
