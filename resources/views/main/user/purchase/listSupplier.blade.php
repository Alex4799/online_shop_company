@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Purchase List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Purchase List</h5>
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
                            <th>Product</th>
                            <th>QTY</th>
                            <th>Total Price(MMK)</th>
                            <th>Supplier</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->total_price}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>{{date('d-m-Y', strtotime($item->created_at));}}</td>
                                    <td>
                                        @if ($item->status==0)
                                            <span class="text-warning">Pending</span>
                                        @elseif($item->status==1)
                                            <span class="text-success">Success</span>
                                        @else
                                            <span class="text-danger">Fail</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('supplier#viewPurchase',$item->id)}}" class="btn btn-secondary btn-sm" title="See More"><i class="bx bx-show"></i></a>
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
