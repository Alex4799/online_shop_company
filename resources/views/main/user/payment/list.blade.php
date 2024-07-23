@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Payment List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Payment List</h5>
              <div class="d-flex justify-content-end py-2">
                <a href="{{route('user#paymentAddPage')}}" class="btn btn-primary">Add Payment</a>
              </div>
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
                            <th>Number</th>
                            <th>User name</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->number}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('user#paymentEdit',$item->id)}}" class="btn btn-success btn-sm my-2" title="Edit payment"><i class="bi bi-hammer"></i></a>
                                            <a href="{{route('user#paymentDelete',$item->id)}}" class="btn btn-danger btn-sm my-2" title="Remove payment"><i class="bi bi-trash"></i></a>

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
