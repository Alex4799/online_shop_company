@extends('main.user.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Show Category</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('user#profile')}}">Profile</a></li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
    </nav>

</div><!-- End Page Title -->
<section class="section">
    <h4 class="text-center py-2">Show Category</h4>
    <div class=" d-flex justify-content-end">
        <button class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus me-2"></i>Add</button>
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
    <div class="row">
        @foreach (Auth::user()->show_category as $item)
            <div class="col-md-4 p-2">
                <div class="card p-2">
                    <form action="{{route('user#updateProductCategory')}}" method="post">
                        @csrf
                        <input type="text" name="category" class="form-control" value="{{$item}}">
                        <div>
                            <input type="hidden" name="index" value="{{$loop->index}}">
                        </div>
                        <div class="py-3">
                            <input type="submit" value="Update" class="btn btn-primary">
                            <a href="{{route('user#deleteProductCategory',$loop->index)}}" class="btn btn-danger">Delete</a>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        <div class="col-md-4 nav-item p-2 d-none" id="add_form">
            <form action="{{route('user#addShowCategory')}}" method="post" enctype="multipart/form-data" class="parents card p-3">
                @csrf
                <div class="py-2">
                    <input type="text" name="category" class="form-control">
                </div>
                <div class="d-flex justify-content-end gap-1">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-upload me-2"></i>Add</button>
                    <button type="button" id="close_form" class="btn btn-danger"><i class="fa-solid fa-trash me-2"></i>Close</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $('#add_btn').click(function(){
                $('#add_form').removeClass('d-none');
            })

            $('#close_form').click(function(){
                $('#add_form').addClass('d-none');
            })
        })
    </script>
@endsection
