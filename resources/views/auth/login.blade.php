@extends('auth.layout')
@section('content')
<div class="" style="height: 100vh;">
    <div class="row container-fluid py-5">
        <div class="col-lg-4 offset-lg-4">
            <div class="p-5 shadow rounded background">
                <div>
                    <h2 class="text-center fs-3">Login Into <span id="title">Angle</span></h2>
                </div>
                <div class="row container-fluid py-3">
                    <div class="col-md-8 offset-md-2">
                        <div id="logo">
                            <img src="{{asset('asset/image/Angle_cover.png')}}" class="w-100" alt="">
                        </div>
                    </div>
                </div>
                <div>
                    <form action="{{route('login')}}" method="post">
                        @csrf

                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger py-3 alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif

                        <div class="py-2">
                            <label for="" class="py-2">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email ....">
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Password</label>
                            <input type="password" name="password" class="form-control passwordInput" placeholder="Enter Your Password ....">
                        </div>
                        <div class="py-2">
                            <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                        </div>
                        <div class="py-2 d-flex justify-content-start">
                            <a href="{{route('auth#registerPage')}}">You don't have an account ? Signup here.</a>
                        </div>
                        <div class="py-2 d-flex justify-content-start">
                            <a href="{{route('password.request')}}">Forgot Password</a>
                        </div>
                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/get/interface',
            dataType:'json',
            success:function(data){
                $('#title').html(data.company_name);
                if (data.company_logo!=null) {
                    $('#logo').html(`<img src="{{asset('storage/interface/${data.company_logo}')}}" alt="" class="w-100 rounded img-thumbnail">`);
                }
            }
        })
    })
</script>
@endsection
