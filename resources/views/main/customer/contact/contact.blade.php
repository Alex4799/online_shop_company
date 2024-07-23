@extends('main.customer.layout.master')
@section('content')
          <!-- Contact Section -->
          <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title py-5" data-aos="fade-up">
              <h2>Contact</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

              <div class="row gx-lg-0 gy-4">

                <div class="col-lg-4">
                  <div class="info-container d-flex flex-column align-items-center justify-content-center">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                      <i class="bi bi-geo-alt flex-shrink-0"></i>
                      <div>
                        <h3>Address</h3>
                        <p>{{$data->company_address}}</p>
                      </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                      <i class="bi bi-telephone flex-shrink-0"></i>
                      <div>
                        <h3>Call Us</h3>
                        <p>{{$data->company_phone}}</p>
                      </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                      <i class="bi bi-envelope flex-shrink-0"></i>
                      <div>
                        <h3>Email Us</h3>
                        <p>{{$data->company_email}}</p>
                      </div>
                    </div><!-- End Info Item -->

                  </div>

                </div>

                <div class="col-lg-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                  <form action="{{route('customer#sendContact')}}" method="post" class=" p-3">
                    @csrf
                    <div class="row gy-4">

                      {{-- <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                      </div> --}}

                      <div class="col-md-12 ">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                      </div>

                      <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                      </div>

                      <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="8" placeholder="Message" required></textarea>
                      </div>

                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Send Message</button>
                      </div>

                    </div>
                  </form>
                </div><!-- End Contact Form -->

              </div>

            </div>

          </section><!-- /Contact Section -->
@endsection
