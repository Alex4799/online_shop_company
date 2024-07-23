@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Supplier Product List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Supplier Product List</h5>
                    <div class="d-flex justify-content-end py-2">
                        <a href="{{route('admin#supplier_productAddPage')}}" class="btn btn-primary">Add Product</a>
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
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th class="col-1">Image</th>
                            <th>Category</th>
                            <th>User</th>
                            <th>Price(MMK)</th>
                            <th>Instock</th>
                            <th>Created At</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td class="col-1">
                                        <div id="{{'carouselExampleFade'.$item->id}}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($item->image as $image)
                                                    <div class="carousel-item @if ($loop->index==0)
                                                            active
                                                        @endif">
                                                        <img src="{{asset('storage/product/'.$image)}}" class="d-block w-100 " alt="product_image">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button class="carousel-control-prev" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                            </button>

                                        </div>
                                    </td>
                                    <td>{{$item->category_name}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->instock}}</td>
                                    <td>{{date('d-m-Y', strtotime($item->created_at));}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('admin#supplier_productView',$item->id)}}" class="btn btn-secondary btn-sm my-2" title="See More"><i class="bx bx-show"></i></a>
                                            <a href="{{route('admin#supplier_deleteProduct',$item->id)}}" class="btn btn-danger btn-sm my-2" title="Remove category"><i class="bi bi-trash"></i></a>
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
