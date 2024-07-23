@extends('main.user.layout.master')
@section('content')
    <div class="pagetitle">
      <h1>Message List</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Message List ({{$status}})</h5>
              <div class="d-flex justify-content-end py-2">
                <a href="{{route('user#messageAddPage')}}" class="btn btn-primary">New Message</a>
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
                                <th>Title</th>
                                <th>Send Email</th>
                                <th>Receive Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($message as $item)
                                <tr class="@if ($item->status==0) table-active @endif">
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->se_email}}</td>
                                    <td>{{$item->re_email}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('user#viewMessage',$item->id)}}" class="btn btn-secondary btn-sm" title="See More"><i class="bx bx-show"></i></a>
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
