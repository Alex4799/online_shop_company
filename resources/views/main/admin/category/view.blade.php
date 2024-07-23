@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>View Category</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#categoryList')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">View Category</h5>

                <div class="py-2">
                    <div class="row">
                        <div class="col-md-6 py-2">
                            @if ($category->image!=null)
                                <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-100" id="image">
                            @else
                                <img src="{{asset('storage/category/'.$category->image)}}" alt="Profile" class="w-100" id="image">
                            @endif
                        </div>
                        <div class="col-md-6 py-2">
                            <div>
                                <h6 class="py-2">Name - {{$category->name}}</h6>
                                <h6 class="py-2">Add By - {{$category->username}}</h6>
                                <h6 class="py-2">Product Item - {{$category->product}}</h6>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
          </div>
    </div>
@endsection
@section('script')

@endsection
