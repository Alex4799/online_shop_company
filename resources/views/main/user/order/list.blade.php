@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Order List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Order List</h5>
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
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Total Price(MMK)</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{$item->invoice_id}}</td>
                                    <td>{{$item->total_price}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>{{date('d-m-Y', strtotime($item->created_at));}}</td>
                                    <td>
                                        @if ($item->status==0)
                                            <span class="text-warning">Pending</span>
                                        @elseif ($item->status==1)
                                            <span class="text-success">Deliver</span>
                                        @elseif ($item->status==2)
                                            <span class="text-success">Success</span>
                                        @elseif ($item->status==4)
                                            <span class="text-danger">Cancel</span>
                                        @else
                                            <span class="text-danger">Fail</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('seller#viewOrder',$item->invoice_id)}}" class="btn btn-secondary btn-sm" title="See More"><i class="bx bx-show"></i></a>
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
