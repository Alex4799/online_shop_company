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
                <div class="py-2">
                    <h3 class=" text-center fs-4">Email Verification</h3>
                </div>
                <div class="py-2">
                    Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </div>
                @if (session('status')=='verification-link-sent')
                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                        A new verification link has been sent to the email address you provided in your profile settings.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        @if (session('status')=='verification-link-sent')
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-secondary">Resend Verification Email</button>
                        </div>
                        @else
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-secondary">Send Verification Email</button>
                        </div>
                        @endif
                    </form>
                </div>
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
