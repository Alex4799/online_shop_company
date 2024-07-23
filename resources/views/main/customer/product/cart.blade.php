@extends('main.customer.layout.master')
@section('content')
    <section class="section">
        <div class="py-5">
            <div class="container-md px-2">
                <h3 class="py-3">Cart</h3>
                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('danger')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <form action="{{route('customer#orderAdd')}}" method="post" id="order_form" class=" col-md-10 offset-md-1" enctype="multipart/form-data">
                        @csrf
                        <div id="alert"></div>
                        <div class="border border-black p-3 my-2">
                            <div>
                                <h3 class="">Product Info</h3>
                                <div class=" table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Seller</th>
                                                <th>QTY</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="products">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 py-2">
                                <div class="card p-4 my-2">
                                    <h5 class=" text-center py-2">Payment Info</h5>
                                    <div class="py-2">
                                        <label for="count" class="form-label">Total</label>
                                        <div><span id="subTotal">0</span> MMK</div>
                                    </div>
                                    <div class="py-2">
                                        <label for="count" class="form-label">Payment Method</label>
                                        <div>
                                            <select name="payment_id" id="payment_id" class="form-control">
                                                <option value="">Choose Payment Method</option>
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

                                    <div id="user_alert">

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
                            <input type="hidden" name="product" id="product">
                            <input type="hidden" name="total_price" id="input_total_price">
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

        $cart=JSON.parse(localStorage.getItem("cart"));

        function getData(){
            $cart=JSON.parse(localStorage.getItem("cart"));
            if ($cart!=null && $cart.length!=0) {
                    $object={
                        'cart':$cart,
                    };
                    $.ajax({
                        type:'get',
                        url:`http://127.0.0.1:8000/customer/product/get`,
                        data:Object.assign({},$object),
                        dataType:'json',
                        success:function(data){
                            $product='';
                            data.forEach(item => {
                                $image=`http://127.0.0.1:8000/storage/product/${item.image[0]}`
                                $product+=`
                                            <tr class="parents">
                                                <td class="col-1">
                                                    <img src="${$image}" class="d-block w-100 " alt="product_image">
                                                </td>
                                                <td class="m-auto text-center">${item.name}</td>
                                                <td class="m-auto text-center">${item.category_name}</td>
                                                <td class="m-auto text-center">${item.user_name}</td>
                                                <td class="col-2"><input class='form-control qty' id="qty" type="number" min="1" value='1' /></td>
                                                <td class="m-auto text-center"><span id="product_price">${item.price}</span> MMK</td>
                                                <td class="m-auto text-center"><span id="product_total_price">${item.price}</span> MMK</td>
                                                <td class="m-auto text-center">
                                                    <input type="hidden" value=${item.instock} id="instock" >
                                                    <input type="hidden" value=${item.id} id="id" >
                                                    <button type='button' class="btn btn-danger delete_item" id=""><i class="fa-solid fa-xmark"></i></button>
                                                </td>
                                            </tr>
                                `;
                            });
                            $('#products').html($product);
                            subTotal();
                        }
                    })

                $.ajax({
                        type:'get',
                        url:`http://127.0.0.1:8000/get/user/payment/${$cart[0].seller_id}`,
                        dataType:'json',
                        success:function(data){
                            $method=`<option value="">Choose Payment Method</option>`;
                            data.forEach(item => {
                                $method+=`<option value="${item.id}">${item.name}</option>`;
                            });
                            $('#payment_id').html($method)
                        }
                })


            }
        }

        function subTotal(){
            $subTotal=0;
            $form_product=[];
            $('#products tr').each(function(index,row){
                $subTotal+=Number($(row).find('#product_total_price').html());
                $form_product_id=$(row).find('#id').val();
                $form_qty=$(row).find('#qty').val();
                $form_product.push({
                    'product_id':$form_product_id,
                    'qty':$form_qty,
                });
            })
            $('#product').val(JSON.stringify($form_product));
            $('#input_total_price').val($subTotal);
            $('#subTotal').html(`${$subTotal}`);
        }

        getData();



        $(document).on("change",".qty",function(){
            $parents=$(this).parents('tr');
            $qty=$(this).val()*1;
            $price=$parents.find('#product_price').html()*1;
            $instock=$parents.find('#instock').val()*1;
            if ($qty<=$instock && $qty>1) {
                $total_price=$price*$qty;
                $parents.find('#product_total_price').html($total_price);
                subTotal();
            }else{
                $('#alert').html(`
                    <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                        Product instock has ${$instock}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }
        });

        $(document).on("click",".delete_item",function(){
            $parents=$(this).parents('tr');
            $product_id=$parents.find('#id').val();
            $result=$cart.filter((item) => {
                return item.product_id!=$product_id;
            })
            localStorage.setItem('cart',JSON.stringify($result));
            getData();
            if ($cart.length==0) {
                $('#products').html('');
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
                }else{
                    $('#cart_nav').html(`Cart`);
                }
            }else{
                $('#cart_nav').html(`Cart`);
            }
        });

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
                        $('#user_alert').removeClass('d-none');
                        $('#user_alert').html(`
                            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                                We were send OTP to your email. Check the OTP and complete your  order.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                        $('#verify').html('Resend Mail');

                    }
                    $('#verifyLoading').addClass('d-none');

                }
            })
            }else{
                $('#user_alert').removeClass('d-none');
                $('#user_alert').html(`
                    <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                        Please Fill User Info Completely
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                $('#verifyLoading').addClass('d-none');
            }
        })

        $('#order').click(function(){
            $('#orderLoading').removeClass('d-none')
            $('#orderLoading').addClass('d-flex')

            $otp_input=$('#otp_input').val();
            $slip=$('#input_image').val();
            $payment_id=$('#payment_id').val();
            if ($otp_input !="" && $slip!='' && $payment_id!='') {
                if ($otp_input==$OTP) {

                    localStorage.setItem('cart',JSON.stringify([]));
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
                $('#alert').addClass('d-none');
                    $('#alert').html(`
                        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        Please Fill Completely.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
            }

        })



    })
</script>
@endsection
