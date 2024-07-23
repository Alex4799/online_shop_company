@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Edit Product</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#productList')}}">List</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Edit Product</h5>

              <form action="{{route('admin#updateProduct')}}" method="post" enctype="multipart/form-data">
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
                    <input id="name" placeholder="Enter your name ...." class="form-control" type="name" name="name" value="{{old('name',$product->name)}}" required autofocus>
                    @error('name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <label for="name" class="form-label">Description</label>
                    <textarea class="tinymce-editor" name="description" id="description" placeholder="Enter your description .....">{{old('description',$product->description)}}</textarea>
                    @error('description')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="row">
                    <div class="py-2 col-md-6">
                        <label for="name" class="d-flex justify-content-between"><p>Image</p><a href="{{route('admin#editProductImage',$product->id)}}">Edit Image</a></label>
                        <div class="py-2">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product->image as $image)
                                        <div class="carousel-item @if ($loop->index==0)
                                                active
                                            @endif">
                                            <img src="{{asset('storage/product/'.$image)}}" class="d-block w-100 " alt="product_image">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="py-2">
                            <label for="name" class="form-label">Category</label>
                            <select name="category_id" id="" class="form-control" required>
                                <option value="">Choose Category</option>
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}" @if ($item->id==$product->category_id)
                                        @selected(true)
                                    @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class=" text-danger">{{$message}}</small>
                          @enderror
                        </div>
                        <div class="py-2">
                            <label for="name" class="form-label">Brand</label>
                            <select name="brand_id" id="" class="form-control">
                                <option value="">Choose Brand</option>
                                @foreach ($brand as $item)
                                    <option value="{{$item->id}}" @if ($item->id==$product->brand_id)
                                        @selected(true)
                                    @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <small class=" text-danger">{{$message}}</small>
                          @enderror
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="py-2 ">
                        <label for="name" class="form-label">Price</label>
                        <input id="name" placeholder="Enter your price ...." class="form-control" type="text" name="price" value="{{old('price',$product->price)}}" required autofocus>
                        @error('price')
                        <small class=" text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <div class="py-2 ">
                        <label for="name" class="form-label">Add Count ( Instock - {{$product->instock}} )</label>
                        <input id="name" placeholder="Enter your count ...." class="form-control" type="number" name="count" value="{{old('count',0)}}" required autofocus>
                        @error('count')
                        <small class=" text-danger">{{$message}}</small>
                      @enderror
                    </div>

                </div>
                <input type="hidden" name="id" value="{{$product->id}}">

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
