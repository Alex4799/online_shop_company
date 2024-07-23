@extends('main.customer.layout.master')
@section('content')
        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
              <div class="row gy-5 justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                  <h2><span>Welcome to </span><span class="accent">{{$data->company_name}}</span></h2>
                  <p>{!!$data->description!!}</p>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                  @if ($data->cover_image==null)
                    <img src="{{asset('asset/customer/assets/img/hero-img.svg')}}" class="img-fluid" alt="">
                  @else
                    <img src="{{asset('storage/interface/'.$data->cover_image)}}" class="img-fluid" alt="">
                  @endif
                </div>
              </div>
            </div>

            <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
              <div class="container position-relative">
                <div class="row gy-4 mt-5">

                  <div class="col-xl-3 col-md-6">
                    <a href="{{route('customer#productList')}}">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-box"></i></div>
                            <h4 class="title">{{count($product)}} Product</h4>
                        </div>
                    </a>
                  </div><!--End Icon Box -->

                  <div class="col-xl-3 col-md-6">
                    <a href="{{route('customer#categoryList')}}">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-card-list"></i></div>
                            <h4 class="title">{{count($category)}} Categories</h4>
                        </div>
                    </a>
                  </div><!--End Icon Box -->

                  <div class="col-xl-3 col-md-6">
                    <a href="{{route('customer#sellerList')}}">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-people"></i></div>
                            <h4 class="title">{{count($user)}} Seller</h4>
                        </div>
                    </a>
                  </div><!--End Icon Box -->

                  <div class="col-xl-3 col-md-6">
                    <a href="{{route('customer#brandList')}}">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-command"></i></div>
                            <h4 class="title">{{count($brand)}} Brand</h4>
                          </div>
                    </a>
                  </div><!--End Icon Box -->

                </div>
              </div>
            </div>

            <section class="section">
                <div class="row product py-3">
                    <div class="col-md-8 offset-md-2 ">
                        <div class="d-flex justify-content-around py-2">
                            <h4>Product</h4>
                            <a href="{{route('customer#productList')}}">See More</a>
                        </div>
                        <hr>
                        @if (count($product)!=0)
                            <div class="py-2">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($product as $item)
                                        <div class="item">
                                            <a href="{{route('customer#viewProduct',$item->id)}}">
                                                <div class="card p-3">
                                                    <div class="py-2">
                                                        @if ($item->image!=[])
                                                            <img src="{{asset('storage/product/'.$item->image[0])}}" class="image-150" alt="">
                                                        @else
                                                            <img src="{{asset('asset/image/default.jpg')}}" class="image-150" alt="">
                                                        @endif
                                                    </div>
                                                    <h6 class="text-center py-2">{{Str::limit($item->name,12)}}</h6>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div>
                                <h6 class="text-center">There is no product.</h6>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row category py-3">
                    <div class="col-md-8 offset-md-2 ">
                        <div class="d-flex justify-content-around py-2">
                            <h4>Category</h4>
                            <a href="{{route('customer#categoryList')}}">See More</a>
                        </div>
                        <hr>
                        @if (count($category)!=0)
                            <div class="py-2">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($category as $item)
                                        <div class="item">
                                            <a href="{{route('customer#categoryProductList',$item->id)}}">
                                                <div class="card p-3">
                                                    <div class="py-2">
                                                        @if ($item->image!='null')
                                                            <img src="{{asset('storage/category/'.$item->image)}}" class="image-150" alt="">
                                                        @else
                                                            <img src="{{asset('asset/image/default.jpg')}}" class="image-150" alt="">
                                                        @endif
                                                    </div>
                                                    <h6 class="text-center py-2">{{Str::limit($item->name,12)}}</h6>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div>
                                <h6 class="text-center">There is no category.</h6>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row brand py-3">
                    <div class="col-md-8 offset-md-2 ">
                        <div class="d-flex justify-content-around py-2">
                            <h4>Brand</h4>
                            <a href="{{route('customer#brandList')}}">See More</a>
                        </div>
                        <hr>
                        @if (count($brand)!=0)
                            <div class="py-2">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($brand as $item)
                                        <div class="item">
                                            <a href="{{route('customer#brandProductList',$item->id)}}">
                                                <div class="card p-3">
                                                    <div class="py-2">
                                                        @if ($item->image!=null)
                                                            <img src="{{asset('storage/brand/'.$item->image)}}" class="w-100" alt="">
                                                        @else
                                                            <img src="{{asset('asset/image/default.jpg')}}" class="w-100" alt="">
                                                        @endif
                                                    </div>
                                                    <h6 class="text-center py-2">{{Str::limit($item->name,12)}}</h6>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div>
                                <h6 class="text-center">There is no brand.</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

        </section><!-- /Hero Section -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            })
        })
    </script>
@endsection
