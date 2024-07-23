@extends('main.customer.layout.master')
@section('content')
        <section class="container-md section">
            <div class="py-5">
                <h4 class="py-2 text-center">Brand List</h4>
                <hr>
                <div class="py-5 d-flex justify-content-between flex-wrap">
                    <div>
                        <h5>Search key - {{request('search_key')}}</h5>
                    </div>
                    <div>
                        <h5>Total - {{$brand->total()}}</h5>
                    </div>
                    <form action="" method="get" class="">
                        <div class="d-flex gap-1">
                            <input type="text" value="{{request('search_key')}}" placeholder="Enter Your Search Key..." class="form-control" name="search_key" id="">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="row">
                    @foreach ($brand as $item)
                        <div class="col-md-4">
                            <a href="{{route('customer#brandProductList',$item->id)}}">
                                <div class="card p-2">
                                    <div class=" card-img d-flex justify-content-center">
                                        @if ($item->image=='null')
                                            <img src="{{asset('asset/image/default.jpg')}}" class="image-250" alt="">
                                        @else
                                            <img src="{{asset('storage/brand/'.$item->image)}}" class="image-250" alt="">
                                        @endif
                                    </div>
                                    <div class="p-2">
                                        <h6 class=" text-center card-title py-2">{{$item->name}}</h6>
                                        <h6 class=" text-center card-title py-2">Product Count - {{$item->count}}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div>
                    {{$brand->appends(request()->query())->links()}}
                </div>
            </div>
        </section>
@endsection
