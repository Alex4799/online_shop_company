@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Edit Product Image</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user#productList')}}">List</a></li>
              <li class="breadcrumb-item"><a href="{{route('user#editProduct',$product->id)}}">Edit</a></li>
              <li class="breadcrumb-item active">Image</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="">
        <div class="shadow rounded p-3">
            <h5 class="card-title text-center">Edit Product</h5>
            <div class=" d-flex justify-content-end">
                <button class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus me-2"></i>Add Image</button>
            </div>
            <div class="py-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('warning')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('danger')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="row p-2">
                @foreach ($product->image as $item)
                    <div class="col-md-4 nav-item p-2">
                        <form action="{{route('user#updateProductImage')}}" method="post" enctype="multipart/form-data" class="parents">
                            @csrf
                            <div class="py-2">
                                <img src="{{asset('storage/product/'.$item)}}" alt="" id="image" class="w-100 rounded img-thumbnail">
                            </div>
                            <div>
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="index" value="{{$loop->index}}">
                            </div>
                            <div class="py-2">
                                <input type="file" name="image" class="form-control input_image">
                            </div>
                            <div class="d-flex justify-content-end gap-1">
                                <button class="btn btn-primary"><i class="fa-solid fa-upload me-2"></i>Update</button>
                                <a href="{{route('user#deleteProductImage',[$product->id,$loop->index])}}" class="btn btn-danger"><i class="fa-solid fa-trash me-2"></i>Remove</a>
                            </div>
                        </form>
                    </div>
                @endforeach
                <div class="col-md-4 nav-item p-2 d-none" id="add_form">
                    <form action="{{route('user#addProductImage')}}" method="post" enctype="multipart/form-data" class="parents">
                        @csrf
                        <div class="py-2">
                            <img src="{{asset('asset/image/default.jpg')}}" alt="" id="image" class="w-100 rounded img-thumbnail">
                        </div>
                        <div>
                            <input type="hidden" name="id" value="{{$product->id}}">
                        </div>
                        <div class="py-2">
                            <input type="file" name="image" class="form-control input_image">
                        </div>
                        <div class="d-flex justify-content-end gap-1">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-upload me-2"></i>Add</button>
                            <button type="button" id="close_form" class="btn btn-danger"><i class="fa-solid fa-trash me-2"></i>Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.input_image').change(function(){
                $parents=$(this).parents('.parents')
                $parents.find('#image').attr("src",window.URL.createObjectURL(this.files[0]));
                // document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);
            })

            $('#add_btn').click(function(){
                $('#add_form').removeClass('d-none');
            })

            $('#close_form').click(function(){
                $('#add_form').addClass('d-none');
            })
        })
    </script>
@endsection
