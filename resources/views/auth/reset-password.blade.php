
@extends('auth.layout')
@section('content')
<div class="" style="height: 100vh;">
    <div class="row container-fluid py-5">
        <div class="col-lg-4 offset-lg-4">
            <div class="p-5 shadow rounded background">
                <div>
                    <h2 class="text-center fs-3"><span id="title">Angle Company</span></h2>
                </div>
                <div class="row container-fluid py-3">
                    <div class="col-md-8 offset-md-2">
                        <div id="logo">
                            <img src="{{asset('asset/image/Angle_cover.png')}}" class="w-100" alt="">
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class=" text-center fs-4">Restart Password</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                        {{session('status')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger py-3 alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="py-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email', $request->email)}}" required autofocus>
                        </div>

                        <div class="py-2">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
                        </div>

                        <div class="py-2">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
                        </div>

                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" class="btn btn-primary" value="Restart">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

