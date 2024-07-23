@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Supplier List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Supplier List</h5>

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
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
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
                                            <a href="{{route('admin#viewSupplier',$item->id)}}" class="btn btn-secondary btn-sm my-2" title="See More"><i class="bx bx-show"></i></a>
                                            @if ($item->status==2)
                                                <a href="{{route('admin#deleteCategory',$item->id)}}" class="btn btn-danger btn-sm my-2" title="Remove Supplier"><i class="bi bi-trash"></i></a>
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
