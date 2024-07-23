@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>View Purchase</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('supplier#listPurchase')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="card col-md-10 offset-md-1">
            <div class="card-body">
              <h5 class="card-title text-center">Purchase Detail </h5>

                <div class="py-2">
                    <div class="d-flex justify-content-between flex-wrap">
                        <h6 class="py-2">Purchase ID - {{$purchase->purchase_id}}</h6>
                        <h6 class="py-2">Date - {{date('d-m-Y', strtotime($purchase->created_at));}}</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-3 py-2">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($purchase->image as $image)
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
                        <div class="col-md-5 py-2">
                            <div>
                                <h6 class="py-2">Product Name - {{$purchase->name}}</h6>
                                <h6 class="py-2">User - {{$purchase->user_name}}</h6>
                                <h6 class="py-2">Quantity - {{$purchase->qty}}</h6>
                                <h6 class="py-2">Total Price - {{$purchase->total_price}} MMK</h6>
                                <h6 class="py-2">Payment Method - {{$purchase->payment_method}}</h6>
                                <div class="">
                                    <h6>Status</h6>
                                    <div class="dropdown">
                                        <button class="btn @if ($purchase->status==0) btn-warning @elseif($purchase->status==1) btn-success  @else btn-danger @endif dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if ($purchase->status==0)
                                                Pending
                                            @elseif($purchase->status==1)
                                                Success
                                            @else
                                                Fail
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{route('supplier#changeStatus',[0,$purchase->purchase_id])}}">Pending</a></li>
                                          <li><a class="dropdown-item" href="{{route('supplier#changeStatus',[1,$purchase->purchase_id])}}">Success</a></li>
                                          <li><a class="dropdown-item" href="{{route('supplier#changeStatus',[2,$purchase->purchase_id])}}">Fail</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 py-2">
                            <h6>Payment Slip</h6>
                            <div>
                                <img src="{{asset('storage/payment/'.$purchase->payment_slip)}}" class="w-100" alt="Paymrnt Slip">
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
