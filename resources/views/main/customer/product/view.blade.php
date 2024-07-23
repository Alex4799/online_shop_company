@extends('main.customer.layout.master')
@section('content')
    <section class="section">
        <div class="py-5">
            <div class="container-md px-2">
                <div class="py-2">
                    <h3 class="">View Product</h3>
                    <nav>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('customer#productList')}}">List</a></li>
                          <li class="breadcrumb-item active">View</li>
                        </ol>
                    </nav>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="" id="alert_message">
                </div>
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
                                            <h6 class="py-2">Instock - {{$product->instock}}</h6>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-warning" id="addToCart">Add To Cart</button>
                                            </div>
                                            <div>
                                                <input type="hidden" value="{{$product->user_id}}" id="seller_id">
                                                <input type="hidden" value="{{$product->id}}" id="product_id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    $(document).ready(function(){

        $('#addToCart').click(function(){
            $cart=JSON.parse(localStorage.getItem("cart"));
            console.log();
            $seller_id=$('#seller_id').val();
            $product_id=$('#product_id').val();
            $data={
                'seller_id':$seller_id,
                'product_id':$product_id,
            }
            console.log($cart);
            if ($cart!=null && $cart.length!=0) {
                if ($cart[0].seller_id==$seller_id) {

                    if ($cart[0].product_id!=$product_id) {
                        $cart.push($data);
                        localStorage.setItem('cart',JSON.stringify($cart));
                        $('#alert_message').html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span id="message">Add to cart successful.</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `)
                    }else{
                        $('#alert_message').html(`
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <span id="message">This product is already in cart.</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `)
                    }

                }else{
                    $('#alert_message').html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span id="message">In the cart , the products of seller must be same.</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    `)
                }

            }else{
                $cart=[$data];
                localStorage.setItem('cart',JSON.stringify($cart));
            }

            $cartLength=JSON.parse(localStorage.getItem("cart"));
            if ($cartLength!=null) {
                if ($cartLength.length!=0) {
                    $('#cart_nav').html(`
                        Cart
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                ${$cartLength.length}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                    `);
                }
            }

        })
    })
    </script>
@endsection
