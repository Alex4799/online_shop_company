@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Order Summary</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('seller#listOrder')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="">
            <h3 class="py-3 text-center">Order Summary</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 p-3 my-2 border border-black">
                        <h3 class="py-2 text-center">User Info</h3>
                        <div class="py-2">
                            <div class="py-2">
                                <h6 class="text-center">User Name - {{$data->user_name}}</h6>
                            </div>
                            <div class="py-2">
                                <h6 class="text-center">User Email - {{$data->user_email}}</h6>
                            </div>
                            <div class="py-2">
                                <h6 class="text-center">User Phone - {{$data->user_phone}}</h6>
                            </div>
                            <div class="py-2">
                                <h6 class="text-center">User Address - {{$data->user_address}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3 my-2 border border-black">
                        <h3 class="py-2 text-center">Order Info</h3>
                        <div class="py-2">
                            <div class="py-2">
                                <h6 class="text-center">Invoice ID - {{$data->invoice_id}}</h6>
                            </div>
                            <div class="py-2">
                                <h6 class="text-center">Total Price - {{$data->total_price}} MMK</h6>
                            </div>
                            <div class="py-2">
                                <h6 class="text-center">Status - </h6>
                                <div class="d-flex justify-content-center">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if ($data->status==0)
                                                <span class="text-warning">Pending</span>
                                            @elseif ($data->status==1)
                                                <span class="text-success">Deliver</span>
                                            @elseif ($data->status==2)
                                                <span class="text-success">Success</span>
                                            @elseif ($data->status==4)
                                                <span class="text-danger">Cancel</span>
                                            @else
                                                <span class="text-danger">Fail</span>
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{route('seller#changeStatus',[0,$data->id])}}">Pending</a></li>
                                          <li><a class="dropdown-item" href="{{route('seller#changeStatus',[1,$data->id])}}">Deliver</a></li>
                                          <li><a class="dropdown-item" href="{{route('seller#changeStatus',[2,$data->id])}}">Success</a></li>
                                          <li><a class="dropdown-item" href="{{route('seller#changeStatus',[3,$data->id])}}">Fail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border border-black p-3 my-2">
                    <div>
                        <h3 class="">Product Info</h3>
                        <div class="">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Seller</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td class="col-1">
                                                <div id="{{'carouselExampleFade'.$item->id}}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach (json_decode($item->image) as $image)
                                                            <div class="carousel-item @if ($loop->index==0)
                                                                    active
                                                                @endif">
                                                                <img src="{{asset('storage/product/'.$image)}}" class="d-block w-100 " alt="product_image">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <button class="carousel-control-prev" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                    </button>

                                                </div>
                                            </td>
                                            <td class="m-auto text-center">{{$item->name}}</td>
                                            <td class="m-auto text-center">{{$item->category_name}}</td>
                                            <td class="m-auto text-center">{{$data->seller_name}}</td>
                                            <td class="m-auto text-center">{{$item->price}}MMK</td>
                                            <td class="m-auto text-center">{{$item->qty}}</td>
                                            <td class="m-auto text-center">{{$item->total}}MMK</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around py-2">
                <a href="{{route('customer#downloadInvoice',$data->invoice_id)}}" class="btn btn-primary" target="_blank">Download Invoice</a>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
