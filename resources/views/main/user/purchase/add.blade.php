@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Buy Product</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user#supplierList')}}">Supplier</a></li>
              <li class="breadcrumb-item"><a href="{{route('user#supplierProductList',$product->user_id)}}">Product</a></li>
              <li class="breadcrumb-item active">Buy Product</li>
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
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary order" id="order">Order</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
          </div>
          <div class="card col-md-10 offset-md-1 d-none" id="form">
            <form action="{{route('user#addPruchase')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="supplier_id" value="{{$product->user_id}}">
                    <input type="hidden" name="price" value="{{$product->price}}" id="price">
                    <input type="hidden" value="{{$product->instock}}" id="instock">
                </div>
                <div class="">
                    <div class="alert alert-warning alert-dismissible fade show my-2 d-none" id="instock_alert" role="alert">

                    </div>
                    <div class="py-2">
                        <label for="count" class="form-label">Count</label>
                        <div>
                            <input id="count" placeholder="Enter your count ...." class="form-control" type="number" name="count" :value="old('count')"  required>
                        </div>
                        @error('count')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="py-2" id="total">

                    </div>
                    <div class="py-2">
                        <label for="count" class="form-label">Payment Method</label>
                        <div>
                            <select name="payment_id" id="payment_id" class="form-control">
                                <option value="">Choose Payment Method</option>
                                @foreach ($method as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="payment_info" class="py-2">

                    </div>
                    <div class="py-2">
                        <label for="name" class="form-label">Payment Slip</label>
                        <div class="row">
                            <div class="col-md-6 py-2 d-flex justify-content-center">
                                <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-50" id="image">
                            </div>
                            <div class="col-md-6 py-2">
                                <input type="file" name="image" class="form-control" id="input_image" required>
                                @error('image')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="py-2 d-flex justify-content-end">
                        <input type="submit" value="Send" class="btn btn-primary">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){

        $('#count').change(function(){
            $qty=$(this).val()*1;
            $instock=$('#instock').val()*1;
            if ($qty<=$instock && $qty>1) {
                $price=$('#price').val()*1;
                $total_price=$price*$qty;
                $('#total').removeClass('d-none');
                $('#total').html(`
                    <label for="">Total Price</label>
                    <input type="text" value="${$total_price} MMK" disabled class="form-control" id="">
                `);
            }else{
                $('#instock_alert').removeClass('d-none');
                $('#instock_alert').html(`
                    Product instock has ${$instock}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `);
            }

        })

        $('#input_image').change(function(){
            document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);
        });

        $('.order').click(function(){
            $('#form').toggleClass('d-none');
        });

        $('#payment_id').change(function(){
            $payment_id=$(this).val();
            $.ajax({
                type:'get',
                url:`http://127.0.0.1:8000/get/payment/${$payment_id}`,
                dataType:'json',
                success:function(data){
                    $('#payment_info').html(`
                        <div class="p-2 border border-black">
                            <h4 class="py-2">Payment Info</h4>
                            <h6 class="py-2">Method Name - ${data.name}</h6>
                            <h6 class="py-2">Number - ${data.number}</h6>
                            <h6 class="py-2">Accunt holder name - ${data.user_name}</h6>
                        </div>
                    `);
                }
            })
        });
    })
</script>
@endsection
