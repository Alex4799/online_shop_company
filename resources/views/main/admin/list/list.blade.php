@extends('main.admin.layout.master')
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
                @if (Auth::user()->position=='CEO')
                    <div class="d-flex justify-content-end py-2">
                        <a href="{{route('admin#addPage')}}" class="btn btn-primary">Add Admin</a>
                    </div>
                @endif
                <div class="py-2">
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
                </div>
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
                                            <a href="{{route('admin#view',$admin->id)}}" class="btn btn-secondary btn-sm my-2" title="See More"><i class="bx bx-show"></i></a>
                                            @if (Auth::user()->position=='CEO')
                                                @if (Auth::user()->id!=$admin->id)
                                                    <a href="{{route('admin#delete',$admin->id)}}" class="btn btn-danger btn-sm my-2" title="Remove admin account"><i class="bi bi-trash"></i></a>
                                                @endif
                                            @endif
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
