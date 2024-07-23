@extends('main.customer.layout.master')
@section('content')
    <section class="section">
        <div class="container-md py-3">
            <h3 class="py-3 text-center">Order Check</h3>
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('warning')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="card p-3 col-md-6 offset-md-3">
                    <form action="{{route('customer#check')}}" method="post" class="">
                        @csrf
                        <div>
                            <label for="">Invoice ID</label>
                            <input type="text" name="invoice" placeholder="Enter invoice number ....." class="form-control">
                        </div>
                        <div class="d-flex justify-content-end py-2">
                            <input type="submit" class="btn btn-primary" value="Check">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
