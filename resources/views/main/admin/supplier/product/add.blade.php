@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Add Supplier Product</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#supplier_productList')}}">List</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Add Supplier Product</h5>

              <form action="{{route('admin#supplier_productAdd')}}" method="post" enctype="multipart/form-data">
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
                    <input id="name" placeholder="Enter your name ...." class="form-control" type="name" name="name" :value="old('name')"  >
                    @error('name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="name" class="form-label">Description</label>
                    <textarea class="tinymce-editor" name="description" id="description" placeholder="Enter your description .....">{{old('description')}}</textarea>
                    @error('description')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="row">
                    <div class="py-2 col-md-6">
                        <label for="name" class="form-label">Image</label>
                        <div class="">
                            <div class="py-2">
                                <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-100" id="image">
                            </div>
                            <div class="py-2">
                                <input type="file" name="image[]" class="form-control" id="input_image" multiple >
                                @error('image')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="py-2 ">
                            <label for="name" class="form-label">Category</label>
                            <select name="category_id" id="" class="form-control" >
                                <option value="">Choose Category</option>
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class=" text-danger">{{$message}}</small>
                          @enderror
                        </div>
                        <div class="py-2">
                            <label for="name" class="form-label">Brand</label>
                            <select name="brand_id" id="" class="form-control" >
                                <option value="">Choose Brand</option>
                                @foreach ($brand as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <small class=" text-danger">{{$message}}</small>
                          @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="py-2 col-md-6">
                        <label for="name" class="form-label">Price</label>
                        <input id="name" placeholder="Enter your price ...." class="form-control" type="text" name="price" :value="old('price')"  >
                        @error('price')
                        <small class=" text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <div class="py-2 col-md-6">
                        <label for="name" class="form-label">Count</label>
                        <input id="name" placeholder="Enter your count ...." class="form-control" type="number" name="count" :value="old('count')"  >
                        @error('count')
                        <small class=" text-danger">{{$message}}</small>
                      @enderror
                    </div>

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
