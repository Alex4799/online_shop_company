@extends('main.admin.layout.master')
@section('content')
    <div class="pagetitle">
        <h1>Edit Interface</h1>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
              <h5 class="card-title text-center">Edit Interface</h5>

              <form action="{{route('admin#updateInterface')}}" method="post" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger py-3 alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                <div class="py-2 CompanyName">
                    <label for="name" class="form-label">Company Name</label>
                    <input id="name" placeholder="Enter your name ...." class="form-control" type="name" name="company_name" value="{{old('company_name',$data->company_name)}}" required autofocus>
                    @error('company_name')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2 company_email">
                    <label for="name" class="form-label">Company Email</label>
                    <input id="name" placeholder="Enter your email ...." class="form-control" type="name" name="company_email" value="{{old('company_email',$data->company_email)}}" required autofocus>
                    @error('company_email')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2 company_address">
                    <label for="name" class="form-label">Company Address</label>
                    <input id="name" placeholder="Enter your address ...." class="form-control" type="name" name="company_address" value="{{old('company_address',$data->company_address)}}" required autofocus>
                    @error('company_address')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2 company_phone">
                    <label for="name" class="form-label">Company Phone</label>
                    <input id="name" placeholder="Enter your phone ...." class="form-control" type="name" name="company_phone" value="{{old('company_phone',$data->company_phone)}}" required autofocus>
                    @error('company_phone')
                    <small class=" text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="py-2 description">
                    <label for="name" class="form-label">Description</label>
                    <textarea class="tinymce-editor" name="description" id="description" placeholder="Enter your description .....">{{old('description',$data->description)}}</textarea>
                    @error('description')
                        <small class=" text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="">
                    <div class="py-2 ">
                        <label for="name" class="form-label">Logo Image</label>
                        <div class="parents row">
                            <div class="py-2 col-md-6 ">
                                @if ($data->company_logo!=null)
                                    <img src="{{asset('storage/interface/'.$data->company_logo)}}" alt="Profile" class="w-75" id="image">
                                @else
                                    <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-75" id="image">
                                @endif
                            </div>
                            <div class="py-2 col-md-6">
                                <input type="file" name="company_logo" class="form-control input_image" id="input_image">
                                @error('company_logo')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="py-2 cover_image">
                        <label for="name" class="form-label">Cover Image</label>
                        <div class="parents row">
                            <div class="py-2 col-md-6 ">
                                @if ($data->cover_image!=null)
                                    <img src="{{asset('storage/interface/'.$data->cover_image)}}" alt="Profile" class="w-75" id="image">
                                @else
                                    <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-75" id="image">
                                @endif
                            </div>
                            <div class="py-2 col-md-6">
                                <input type="file" name="cover_image" class="form-control input_image" id="input_image">
                                @error('cover_image')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="py-2 about_us_description">
                        <label for="name" class="form-label">About Us Description</label>
                        <textarea class="tinymce-editor" name="about_us_description" id="description" placeholder="Enter your description .....">{{old('about_us_description',$data->about_us_description)}}</textarea>
                        @error('about_us_description')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="name" class="d-flex justify-content-between"><p>About Us Image</p><a href="{{route('admin#editAboutImage')}}">Edit Image</a></label>
                        <div class="py-2 d-flex justify-content-center">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade w-50" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($data->about_us_image as $image)
                                        <div class="carousel-item @if ($loop->index==0)
                                                active
                                            @endif">
                                            <img src="{{asset('storage/interface/'.$image)}}" class="d-block w-100 " alt="product_image">
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                                </button>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="py-2 about_us_image">
                        <label for="name" class="form-label">About Us Image</label>
                        <div class="parents row">
                            <div class="py-2 col-md-6">
                                @if ($data->about_us_image!=null)
                                    <img src="{{asset('storage/interface/'.$data->about_us_image)}}" alt="Profile" class="w-75" id="image">
                                @else
                                    <img src="{{asset('asset/image/default.jpg')}}" alt="Profile" class="w-75" id="image">
                                @endif
                            </div>
                            <div class="py-2 col-md-6">
                                <input type="file" name="about_us_image" class="form-control input_image" id="input_image" multiple>
                                @error('about_us_image')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="py-2 footer_description">
                        <label for="name" class="form-label">Footer Description</label>
                        <textarea class="tinymce-editor" name="footer_description" id="description" placeholder="Enter your description .....">{{old('footer_description',$data->footer_description)}}</textarea>
                        @error('footer_description')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>

                <div class="">
                    <div class="py-2 d-flex justify-content-end flex-wrap">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </div>
            </form>

            </div>
          </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.input_image').change(function(){
                $parents=$(this).parents('.parents')
                $parents.find('#image').attr("src",window.URL.createObjectURL(this.files[0]));
            })
        })
    </script>
@endsection
