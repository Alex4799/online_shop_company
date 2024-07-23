@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Add Admin</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#list')}}">List</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Add Admin</h5>

              <form action="{{route('‌admin#add')}}" method="post">
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
                    <input id="name" placeholder="Enter your name ...." class="form-control" type="name" name="name" :value="old('name')"  >
                    @error('name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" placeholder="Enter your email ...." class="form-control" type="email" name="email" :value="old('email')"  >
                    @error('email')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" placeholder="Enter your phone ...." class="form-control" type="phone" name="phone" :value="old('phone')"  >
                    @error('phone')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="address" class="form-label">Address</label>
                    <input id="address" placeholder="Enter your address ...." class="form-control" type="address" name="address" :value="old('address')"  >
                    @error('address')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="position" class="form-label">Position</label>
                    <input id="position" placeholder="Enter your position ...." class="form-control" type="position" name="position" :value="old('address')"  >
                    @error('position')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-control" type="text" name="gender" >
                        <option value="">Choose Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" placeholder="Enter your password ...." class="form-control passwordInput" type="password" name="password"  autocomplete="current-password">
                    @error('password')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="py-2">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" placeholder="Enter your password ...." class="form-control passwordInput" type="password" name="password_confirmation"  autocomplete="current-password">
                    @error('password_confirmation')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="">
                    <div class="py-2">
                        <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                    </div>
                    <div class="py-2 d-flex justify-content-end flex-wrap">
                        <input type="submit" value="Register" class="btn btn-primary">
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
