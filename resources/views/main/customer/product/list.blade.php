@extends('main.customer.layout.master')
@section('content')
        <section class="container-md section">
            <div class="py-5">
                <h4 class="py-2 text-center">Product List</h4>
                <hr>
                <div class="row p-4">
                    <div class="col-md-3 py-3">
                        <h6>Filter By Price</h6>
                        <form action="" method="get" class="">
                            <div class="py-2">
                                <label for="">Min</label>
                                <input type="number" value="{{request('min')}}" name="min" id="" class="form-control">
                            </div>
                            <div class="py-2">
                                <label for="">Max</label>
                                <input type="number" name="max" value="{{request('max')}}" id="" class="form-control">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{route('customer#productList')}}" class="btn btn-primary">Remove Filter</a>
                                <input type="submit" value="Show Result" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="py-5 d-flex justify-content-between flex-wrap">
                            <div>
                                <h5>Search key - {{request('search_key')}}</h5>
                            </div>
                            <div>
                                <h5>Total - {{$product->total()}}</h5>
                            </div>
                            <form action="" method="get" class="">
                                <div class="d-flex gap-1">
                                    <input type="text" value="{{request('search_key')}}" placeholder="Enter Your Search Key..." class="form-control" name="search_key" id="">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            @foreach ($product as $item)
                                <div class="col-md-4 p-1">
                                    <div class="card p-2 h-100">
                                        <div class=" card-img h-50">
                                            <div id="{{'carouselExampleFade'.$item->id}}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($item->image as $image)
                                                        <div class="carousel-item d-flex justify-content-center @if ($loop->index==0)
                                                                active
                                                            @endif">
                                                            <img src="{{asset('storage/product/'.$image)}}" class="d-block image-250 image-hover" alt="product_image">
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button class="carousel-control-prev" type="button" data-bs-target="#{{'carouselExampleFade'.$item->id}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#{{'carouselExampleFade'.$item->id}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                                </button>

                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <h6 class=" text-center card-title py-2">{{$item->name}}</h6>
                                            <div>
                                                <h6 class="py-2">Category - {{$item->category_name}}</h6>
                                                @if ($item->brand_id!=null)
                                                    <h6 class="py-2">Brand - {{$item->brand_name}}</h6>
                                                @endif
                                                <h6 class="py-2">Price - {{number_format($item->price)}} MMK</h6>
                                                <h6 class="py-2">Instock - {{$item->instock}}</h6>
                                            </div>
                                            @if ($item->instock!=0)
                                                <div class="d-flex justify-content-end">
                                                    <a href="{{route('customer#viewProduct',$item->id)}}" class="btn btn-primary">See More</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            {{$product->appends(request()->query())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
