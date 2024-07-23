@extends('main.user.layout.master')
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
              <div>
                <div class="row">
                    @foreach ($supplier as $item)
                        <div class="card col-md-4">
                            <a href="{{route('user#supplierProductList',$item->id)}}">
                                <div class="py-2">
                                    @if (Auth::user()->image==null)
                                        @if (Auth::user()->gender=='female')
                                            <img src="{{asset('asset/image/default-female-image.webp')}}" alt="Profile" class="w-100 rounded">
                                        @else
                                            <img src="{{asset('asset/image/default-male-image.png')}}" alt="Profile" class="w-100 rounded">
                                        @endif
                                    @else
                                        <img src="{{asset('storage/profile/'.$item->image)}}" class="w-100 rounded" alt="">
                                    @endif

                                </div>
                                <div class="py-2">
                                    <h6 class="py-2">Name - {{$item->name}}</h6>
                                    <h6 class="py-2">Email - {{$item->email}}</h6>
                                    <h6 class="py-2">Phone - {{$item->phone}}</h6>
                                    <h6>Category</h6>
                                    <div class="d-flex flex-wrap gap-1 py-2">
                                        @foreach ($item->show_category as $item)
                                            <button class="btn btn-outline-secondary">{{$item}}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
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
