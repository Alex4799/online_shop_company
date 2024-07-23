@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Category List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Category List</h5>
              <div class="d-flex justify-content-end py-2">
                <a href="{{route('user#categoryAddPage')}}" class="btn btn-primary">Add Category</a>
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
              <table class="table datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Add By</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                <div class="">
                                    <a href="{{route('user#viewCategory',$item->id)}}" class="btn btn-secondary btn-sm my-2" title="See More"><i class="bx bx-show"></i></a>
                                    @if ($item->add_by==Auth::user()->id)
                                        <a href="{{route('user#editCategory',$item->id)}}" class="btn btn-success btn-sm my-2" title="Edit category"><i class="bi bi-hammer"></i></a>
                                        @if ($item->id!=1)
                                            <a href="{{route('user#deleteCategory',$item->id)}}" class="btn btn-danger btn-sm my-2" title="Remove category"><i class="bi bi-trash"></i></a>
                                        @endif
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection
@section('script')
@endsection
