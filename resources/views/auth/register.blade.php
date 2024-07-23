@extends('auth.layout')
@section('content')
<div class="" style="height: 100vh;">
    <div class="row container-fluid py-5">
        <div class="col-lg-4 offset-lg-4">
            <div class="p-5 shadow rounded background">
                <div>
                    <h2 class="text-center fs-3">Signup Into <span id="title">Angle</span></h2>
                </div>
                <div class="row container-fluid py-3">
                    <div class="col-md-8 offset-md-2">
                        <div id="logo">
                            <img src="{{asset('asset/image/Angle_cover.png')}}" class="w-100" alt="">
                        </div>
                    </div>
                </div>
                <div>
                    <form action="{{route('register')}}" method="post">
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
                            <label for="name" class="form-label">Name</label>
                            <input id="name" placeholder="Enter your name ...." class="form-control" type="name" name="name" :value="old('name')" required autofocus>
                        </div>
                        <div class="py-2">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" placeholder="Enter your email ...." class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                        </div>
                        <div class="py-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" placeholder="Enter your phone ...." class="form-control" type="phone" name="phone" :value="old('phone')" required autofocus>
                        </div>
                        <div class="py-2">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" placeholder="Enter your address ...." class="form-control" type="address" name="address" :value="old('address')" required autofocus>
                        </div>
                        <div class="py-2">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" class="form-control" type="text" name="gender" required>
                                <option value="">Choose Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="py-2">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" placeholder="Enter your password ...." class="form-control passwordInput" type="password" name="password" required autocomplete="current-password">
                        </div>
                        <div class="py-2">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" placeholder="Enter your password ...." class="form-control passwordInput" type="password" name="password_confirmation" required autocomplete="current-password">
                        </div>
                        <div class="">
                            <div class="py-2">
                                <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                            </div>
                            <div class="py-2 d-flex justify-content-between flex-wrap">
                                <a class="text-dark " href="{{ route('auth#loginPage') }}">Do You Have An Account ?</a>
                                <input type="submit" value="Register" class="btn btn-primary">
                            </div>
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
                    $('#logo').html(`<img src="{{asset('image/interface/${data.company_logo}')}}" alt="" class="w-100 rounded img-thumbnail">`);
                }
            }
        })
    })
</script>
@endsection
