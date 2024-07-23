@extends('main.customer.layout.master')
@section('content')
        <section class="container-md section">
            <div class="py-5 px-3">
                <h4 class="py-2 text-center">Seller List</h4>
                <hr>
                <div class="py-5 d-flex justify-content-between flex-wrap">
                    <div>
                        <h5>Search key - {{request('search_key')}}</h5>
                    </div>
                    <div>
                        <h5>Total - {{$user->total()}}</h5>
                    </div>
                    <form action="" method="get" class="">
                        <div class="d-flex gap-1">
                            <input type="text" value="{{request('search_key')}}" placeholder="Enter Your Search Key..." class="form-control" name="search_key" id="">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="row">
                    @foreach ($user as $item)
                        <div class="col-md-4 p-1">
                            <div class="card p-2">
                                <div class=" card-img d-flex justify-content-center">
                                    @if ($item->image==null)
                                        @if ($item->gender=='male')
                                            <img src="{{asset('asset/image/default-male-image.png')}}" class="w-75" alt="">
                                        @else
                                            <img src="{{asset('asset/image/default-female-image.webp')}}" class="w-75" alt="">
                                        @endif
                                    @else
                                        <img src="{{asset('storage/profile/'.$item->image)}}" class="w-75" alt="">
                                    @endif
                                </div>
                                <div class="p-2">
                                    <h6 class=" text-center card-title py-2">{{$item->name}}</h6>
                                    <h6 class=" text-center card-title py-2">Email - {{$item->email}}</h6>
                                    <h6 class=" text-center card-title py-2">Address - {{$item->address}}</h6>
                                    <h6 class=" text-center card-title py-2">Product Count - {{$item->count}}</h6>
                                    <div class="d-flex flex-wrap gap-1 py-2">
                                        @foreach ($item->show_category as $category)
                                            <button class="btn btn-outline-secondary">{{$category}}</button>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap gap-1">
                                        <a href="{{route('customer#sellerProfile',$item->id)}}" class="btn btn-primary">Profile</a>
                                        <a href="{{route('customer#sellerProductList',$item->id)}}" class="btn btn-primary">Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div>
                    {{$user->appends(request()->query())->links()}}
                </div>
            </div>
        </section>
@endsection
