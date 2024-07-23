@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Admin List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admin List</h5>
              <!-- Table with stripped rows -->
                <div class=" table-responsive">
                    <table class="table datatable">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->address}}</td>
                                    <td>{{$admin->gender}}</td>
                                    <td>{{$admin->position}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('user#adminView',$admin->id)}}" class="btn btn-secondary btn-sm" title="See More"><i class="bx bx-show"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection
@section('script')
@endsection
