@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>View Brand</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user#brandList')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">View Brand</h5>

                <div class="py-2">
                    <div class="row">
                        <div class="col-md-6 py-2">
                            <img src="{{asset('storage/brand/'.$brand->image)}}" alt="Brand Photo" class="w-100" id="image">
                        </div>
                        <div class="col-md-6 py-2">
                            <div>
                                <h6 class="py-2">Name - {{$brand->name}}</h6>
                                <h6 class="py-2">Product Item - {{$brand->product}}</h6>

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
