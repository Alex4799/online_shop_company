@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>View Supplier Product</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#supplier_productList')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-10 offset-md-1">
            <div class="card-body">
              <h5 class="card-title text-center">{{$product->name}}</h5>

                <div class="py-2">
                    <div class="row">
                        <div class="col-md-6 py-2">
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
                        <div class="col-md-6 py-2">
                            <div>
                                <p>{!!$product->description!!}</p>
                                <h6 class="py-2">Add By - {{$product->user_name}}</h6>
                                <h6 class="py-2">Category - {{$product->category_name}}</h6>
                                @if ($product->brand_id!=null)
                                    <h6 class="py-2">Brand - {{$product->brand_name}}</h6>
                                @endif
                                <h6 class="py-2">Price - {{$product->price}} MMK</h6>
                                <h6 class="py-2">Count - {{$product->count}}</h6>
                                <h6 class="py-2">Instock - {{$product->instock}}</h6>

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
