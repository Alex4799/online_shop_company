use App\Models\Product;
@extends('main.customer.layout.master')
@section('content')
    <section class="section">
        <div class="py-5">
            <div class="container-md px-2">
                <h3 class="py-3">Order Product</h3>
                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('danger')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <form action="{{route('customer#orderAdd')}}" method="post" id="order_form" class=" col-md-10 offset-md-1" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-warning alert-dismissible fade show my-2 d-none" id="all_alert" role="alert">

                        </div>
                        <div class="row">
                            <div class="col-md-6 py-2">
                                <div class="card p-4 my-2">
                                    <h5 class=" text-center py-2">Product Info</h5>
                                    <div class="py-2">
                                        <label for="username">Product Name</label>
                                        <input type="text" name="product_name" disabled class="form-control" value="{{$product->name}}" id="">
                                    </div>
                                    <div class="py-2">
                                        <label for="username">Product Price</label>
                                        <input type="text" disabled class="form-control" value="{{$product->price}} MMK">
                                        <input type="hidden" name="product_price" value="{{$product->price}}" id="price">
                                    </div>
                                    <div class="alert alert-warning alert-dismissible fade show my-2 d-none" id="instock_alert" role="alert">

                                    </div>
                                    <div class="py-2">
                                        <label for="username">Product Quantity</label>
                                        <input type="number" name="qty" class="form-control" required value="{{old('qty')}}" min="1" id="qty">
                                        @error('qty')
                                            <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <input type="hidden" value="{{$product->instock}}" id="instock">
                                    <div>
                                        <div class="py-2 d-none" id="total">
                                            <label for="">Total Price</label>
                                            <input type="number" disabled class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-4 my-2">
                                    <h5 class=" text-center py-2">Payment Info</h5>
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
                                                <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-100" id="image">
                                            </div>
                                            <div class="col-md-6 py-2">
                                                <input type="file" name="image" class="form-control" id="input_image" required>
                                                @error('image')
                                                    <small class=" text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 py-2">
                                <div class="card p-4 my-2">
                                    <h5 class="text-center py-3">Customer Info</h5>

                                    <div class="d-none justify-content-center" id="verifyLoading">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                          </div>
                                    </div>

                                    <div class="alert alert-warning alert-dismissible fade show my-2 d-none" id="alert" role="alert">

                                    </div>
                                    <div class="alert alert-success alert-dismissible fade show my-2 d-none" id="successAlret" role="alert">

                                    </div>

                                    <div class="py-2">
                                        <label for="username">User Name</label>
                                        <input type="text" name="username" class="form-control" required value="{{old('username')}}" id="username">
                                    </div>

                                    <div class="py-2">
                                        <label for="email">User Email</label>
                                        <input type="text" name="email" class="form-control" required value="{{old('email')}}" id="email">
                                    </div>

                                    <div class="py-2">
                                        <label for="phone">User Phone</label>
                                        <input type="text" name="phone" class="form-control" required value="{{old('phone')}}" id="phone">
                                    </div>

                                    <div class="py-2">
                                        <label for="address">User Address</label>
                                        <textarea name="address" class="form-control" id="address" cols="30" rows="5" required>{{old('address')}}</textarea>
                                    </div>
                                    <div class="py-2 d-flex justify-content-end">
                                        <button class="btn btn-primary" type="button" id="verify">Verify User</button>
                                    </div>
                                </div>
                                <div class="card p-4 my-2 d-none" id="OTP">
                                    <h5 class="text-center py-3">OTP</h5>
                                    <div class="d-none justify-content-center" id="orderLoading">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                          </div>
                                    </div>
                                    <div class="alert alert-danger alert-dismissible fade show my-2 d-none" id="otp_alert" role="alert">

                                    </div>
                                    <div class="py-2">
                                        <label for="username">Enter OTP</label>
                                        <input type="text" class="form-control" id="otp_input">
                                    </div>
                                    <div class="py-2 d-flex justify-content-end">
                                        <button class="btn btn-primary" type="button" id="order">Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    $('document').ready(function(){
        $('#qty').change(function(){
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

        $('#payment_id').change(function(){
            $payment_id=$(this).val();
            if ($payment_id!='') {
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
            }
        });

        $('#input_image').change(function(){
            document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);
        });

        $('#verify').click(function(){

            $('#verifyLoading').removeClass('d-none');
            $('#verifyLoading').addClass('d-flex');

            $username=$('#username').val();
            $email=$('#email').val();
            $phone=$('#phone').val();
            $address=$('#address').val();
            if ($username!=''&&$email!=''&&$phone!=''&&$address!='') {
                $OTP=Math.floor(Math.random()*100001),
                $data={
                    username:$username,
                    email:$email,
                    phone:$phone,
                    address:$address,
                    otp:$OTP,
                };
                $.ajax({
                type:'get',
                url:`{{route('customer#userVerify')}}`,
                dataType:'json',
                data:Object.assign($data),
                success:function(data){
                    if (data.status=='successful') {
                        $('#OTP').removeClass('d-none');
                        $('#successAlret').removeClass('d-none');
                        $('#successAlret').html(`
                            We were send OTP to your email. Check the OTP and complete your  order.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `);
                        $('#verify').html('Resend Mail');

                    }
                    $('#verifyLoading').addClass('d-none');

                }
            })
            }else{
                $('#alert').removeClass('d-none');
                $('#alert').html(`
                    Please Fill Completely
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `);
                $('#verifyLoading').addClass('d-none');
            }
        })

        $('#order').click(function(){
            $('#orderLoading').removeClass('d-none')
            $('#orderLoading').addClass('d-flex')

            $otp_input=$('#otp_input').val();
            $qty=$('#qty').val();
            $slip=$('#input_image').val();
            $payment_id=$('#payment_id').val();
            if ($otp_input !="" && $qty != "" && $slip!='' && $payment_id!='') {
                if ($otp_input==$OTP) {
                    $('#order_form').submit();
                    $('#orderLoading').addClass('d-none')
                }else{
                    $('#otp_alert').html(`
                        Worng OTP. Please check the email and try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `);
                    $('#orderLoading').addClass('d-none')
                }
            }else{
                $('#all_alert').addClass('d-none');
                    $('#all_alert').html(`
                       Please Fill Completely.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `);
            }

        })

    })
</script>
@endsection
