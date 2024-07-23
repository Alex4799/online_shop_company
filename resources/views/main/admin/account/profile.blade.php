@extends('main.admin.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Profile</h1>

  </div><!-- End Page Title -->
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger py-3 alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('danger')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            @if (Auth::user()->image==null)
                @if (Auth::user()->gender=='female')
                    <img src="{{asset('asset/image/default-female-image.webp')}}" alt="Profile" class="rounded-circle">
                @else
                    <img src="{{asset('asset/image/default-male-image.png')}}" alt="Profile" class="rounded-circle">
                @endif
            @else
                <img src="{{asset('storage/profile/'.Auth::user()->image)}}" alt="Profile" class="rounded-circle">
            @endif
            <h2>{{Auth::user()->name}}</h2>
            <h3>{{Auth::user()->position}}</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Name</div>
                  <div class="col-lg-9 col-md-8">{{Auth::user()->name}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Position</div>
                  <div class="col-lg-9 col-md-8">{{Auth::user()->position}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{Auth::user()->address}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{Auth::user()->phone}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{route('admin#profileUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                        @if (Auth::user()->image==null)
                            @if (Auth::user()->gender=='female')
                                <img src="{{asset('asset/image/default-female-image.webp')}}" alt="Profile" id="image">
                            @else
                                <img src="{{asset('asset/image/default-male-image.png')}}" alt="Profile" id="image">
                            @endif
                        @else
                            <img src="{{asset('storage/profile/'.Auth::user()->image)}}" alt="Profile" id="image">
                        @endif
                      <div class="py-2">
                        <input type="file" name="image" class="form-control" id="input_image">
                      </div>
                      <div class="pt-2">
                        <a href="{{route('admin#deleteProfile',Auth::user()->id)}}" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{Auth::user()->name}}">
                      @error('name')
                        <small class=" text-danger">{{$message}}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="{{Auth::user()->address}}">
                    @error('address')
                        <small class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="{{Auth::user()->phone}}">
                        @error('phone')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{Auth::user()->email}}">
                      @error('email')
                        <small class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="gender" id="Gender" class=" form-control">
                        <option value="">Choose your gender</option>
                        <option value="male" @if (Auth::user()->gender=='male') @selected(true) @endif>Male</option>
                        <option value="female" @if (Auth::user()->gender=='female') @selected(true) @endif>Female</option>
                      </select>
                      @error('gender')
                      <small class=" text-danger">{{$message}}</small>
                    @enderror
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="{{route('auth#changePassword')}}" method="POST">
                    @csrf
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="current_password" type="password" class="form-control passwordInput" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password" type="password" class="form-control passwordInput" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renew_password" type="password" class="form-control passwordInput" id="renewPassword">
                    </div>
                  </div>

                    <div class="py-2">
                        <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                    </div>

                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#input_image').change(function(){
                document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);
            })
        })
    </script>
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
