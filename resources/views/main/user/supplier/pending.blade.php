@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Pending Supplier</h1>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Pending Supplier</h5>
                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('danger')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
              <form action="{{route('user#pendingSupplier')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="py-2">
                    <h4>Supplier policy</h4>
                    <p>{!!$data->supplier_policy!!}</p>
                </div>
                <div class="py-2">
                    <input type="checkbox" name="agree" class="m-2" required>I had read and agree the policy.
                </div>
                <div class="py-2">
                    <label for="password" class="form-label">Enter your password to send pending</label>
                    <input id="password" placeholder="Enter your password ...." class="form-control passwordInput" type="password" name="password"  autocomplete="current-password" required>
                    @error('password')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2">
                    <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                </div>

                <div class="">
                    <div class="py-2 d-flex justify-content-end flex-wrap">
                        <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                </div>
            </form>

            </div>
          </div>
    </div>
@endsection
@section('script')
<script>
        function changeInputType() {
            let input = document.getElementsByClassName('passwordInput');
            for (let i = 0; i < input.length; i++) {
                if (input[i].type === "password") {
                    input[i].type = "text";
                } else {
                    input[i].type = "password";
                }

            }
        }
</script>
@endsection
