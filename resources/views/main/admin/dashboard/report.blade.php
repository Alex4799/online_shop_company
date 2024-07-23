@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Report</h1>

    </div><!-- End Page Title -->

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
    <section class="section dashboard">
        <div class="row">
            <div class="card col-md-8 offset-md-2">
                <div class="card-body">
                  <h5 class="card-title text-center">Report Form</h5>

                  <form action="{{route('admin#viewReport')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger py-3 alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endforeach
                    @endif

                    <div class="row">
                        <div class="py-2 col-md-6">
                            <label for="start" class="form-label">Start Date</label>
                            <input id="start" class="form-control" type="date" name="start" value="" >
                            @error('name')
                            <small class=" text-danger">{{$message}}</small>
                          @enderror
                        </div>
                        <div class="py-2 col-md-6">
                            <label for="end" class="form-label">End Date</label>
                            <input id="end" class="form-control" type="date" name="end" value="" >
                            @error('name')
                            <small class=" text-danger">{{$message}}</small>
                          @enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="py-2 d-flex justify-content-end flex-wrap">
                            <input type="submit" value="Generate" class="btn btn-primary">
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </section>
@endsection
@section('script')

@endsection
