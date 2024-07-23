@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Brand List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Brand List</h5>
              <div class="d-flex justify-content-end py-2">
                <a href="{{route('admin#brandAddPage')}}" class="btn btn-primary">Add Brand</a>
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
                                <th class="col-4 col-md-2">Image</th>
                                <th>Name</th>
                                <th>Add By</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brand as $item)
                                <tr>
                                    <td class="col-4 col-md-2"><img src="{{asset('storage/brand/'.$item->image)}}" alt="Brand Photo" class="w-100" id="image"></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('admin#viewBrand',$item->id)}}" class="btn btn-secondary btn-sm my-2" title="See More"><i class="bx bx-show"></i></a>
                                            <a href="{{route('admin#editBrand',$item->id)}}" class="btn btn-success btn-sm my-2" title="Edit Brand"><i class="bi bi-hammer"></i></a>
                                            <a href="{{route('admin#deleteBrand',$item->id)}}" class="btn btn-danger btn-sm my-2" title="Remove Brand"><i class="bi bi-trash"></i></a>

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
