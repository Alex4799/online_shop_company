@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>View Supplier</h1>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin#supplierList')}}">List</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">View Supplier</h5>

                <div class="py-2">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 py-2">
                            <div>
                                <h6 class="py-2">Name - <a href="{{route('admin#viewUser',$supplier->user_id)}}">{{$supplier->name}}</a></h6>
                                <h6 class="py-2">Email - {{$supplier->email}}</h6>
                                <h6 class="py-2">Phone - {{$supplier->phone}}</h6>
                                <h6 class="py-2">Address - {{$supplier->address}}</h6>
                                <h6 class="py-2">Total Purchase - {{$supplier->purchase}}</h6>
                                <p>{!!$supplier->description!!}</p>
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if ($supplier->status==0)
                                                Pending
                                            @elseif($supplier->status==1)
                                                Success
                                            @else
                                                Fail
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{route('admin#changeStatus',[0,$supplier->id])}}">Pending</a></li>
                                          <li><a class="dropdown-item" href="{{route('admin#changeStatus',[1,$supplier->id])}}">Success</a></li>
                                          <li><a class="dropdown-item" href="{{route('admin#changeStatus',[2,$supplier->id])}}">Fail</a></li>
                                        </ul>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          </div>
    </div>
@endsection
@section('script')

@endsection
