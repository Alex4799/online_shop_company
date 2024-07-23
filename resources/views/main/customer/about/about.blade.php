@extends('main.customer.layout.master')
@section('content')
              <!-- About Section -->
            <section id="about" class="about section">

                <!-- Section Title -->
                <div class="container section-title py-5" data-aos="fade-up">
                  <h2>About Us<br></h2>
                </div><!-- End Section Title -->

                <div class="container">

                  <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100"><p>{!!$data->about_us_description!!}</p></div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="py-2 d-flex justify-content-center">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
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
                  </div>

                </div>

            </section><!-- /About Section -->
@endsection

