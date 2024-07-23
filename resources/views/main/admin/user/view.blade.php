@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#userList')}}">List</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            @if ($user->image==null)
                @if ($user->gender=='female')
                    <img src="{{asset('asset/image/default-female-image.webp')}}" alt="Profile" class="rounded-circle">
                @else
                    <img src="{{asset('asset/image/default-male-image.png')}}" alt="Profile" class="rounded-circle">
                @endif
            @else
                <img src="{{asset('storage/profile/'.$user->image)}}" alt="Profile" class="rounded-circle">
            @endif
            <h2>{{$user->name}}</h2>
            <h3>{{$user->position}}</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>

                <h5 class="card-title">User Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Name</div>
                  <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Position</div>
                  <div class="col-lg-9 col-md-8">{{$user->position}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{$user->address}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{$user->phone}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Active</div>
                    <div class="col-lg-9 col-md-8">
                        @if ($user->active==0)
                            <span class="text-danger">Not Active</span>
                        @else
                            <span class="text-success">Active</span>
                        @endif
                    </div>
                </div>

                <div>
                    <a href="{{route('admin#sendUser',$user->id)}}" class="btn btn-primary">Send Email</a>
                </div>

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
