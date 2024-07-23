<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title class="company_name">Angle</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('asset/image/ANGLE_logo.png')}}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('asset/customer/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('asset/customer/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('asset/customer/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('asset/customer/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('asset/customer/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('asset/customer/assets/css/main.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('asset/owlcarousel/dist/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('asset/owlcarousel/dist/assets/owl.theme.default.min.css')}}">
    @yield('style')
</head>

<body class="index-page">

  <header id="header" class="header fixed-top">

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{route('customer#home')}}" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <div class="company_logo">
            <img src="{{asset('asset/customer/assets/img/logo.png')}}" alt="">
          </div>
          <h1 class="sitename company_name">Impact</h1>
          <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu d-flex justify-content-between gap-1">
          <ul>
            <li><a href="{{route('customer#home')}}" class="@if (url()->current()==route('customer#home')) active @endif">Home<br></a></li>
            <li class="dropdown"><a href="#"><span>Product</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="{{route('customer#productList')}}">All List</a></li>
                  <li><a href="{{route('customer#categoryList')}}">Category</a></li>
                  <li><a href="{{route('customer#brandList')}}">Brand</a></li>
                  <li><a href="{{route('customer#sellerList')}}">Seller</a></li>
                </ul>
            </li>
            <li><a href="{{route('customer#categoryList')}}" class="@if (url()->current()==route('customer#categoryList')) active @endif">Category</a></li>
            <li><a href="{{route('customer#brandList')}}" class="@if (url()->current()==route('customer#brandList')) active @endif">Brand</a></li>
            <li><a href="{{route('customer#sellerList')}}" class="@if (url()->current()==route('customer#sellerList')) active @endif">Seller</a></li>
            <li><a href="{{route('customer#checkPage')}}" class="@if (url()->current()==route('customer#checkPage')) active @endif">Order</a></li>
            <li><a href="{{route('customer#cartList')}}" class="@if (url()->current()==route('customer#cartList')) active @endif position-relative" id="cart_nav">Cart</a></li>
            <li><a href="{{route('customer#about')}}" class="@if (url()->current()==route('customer#about')) active @endif">About</a></li>
            <li><a href="{{route('customer#contact')}}" class="@if (url()->current()==route('customer#contact')) active @endif">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            <div class="form-check form-switch m-auto">
                <input class="form-check-input" type="checkbox" onclick="changemood()" role="switch" id="darkmood" >
                <span class="form-check-label dark-mood-color" for="darkmood">Dark</span>
            </div>
        </nav>

        <a href="{{route('auth#loginPage')}}" class="btn btn-outline-secondary">Login</a>

      </div>

    </div>

  </header>

  <main class="main">

    @yield('content')

  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="{{route('customer#home')}}" class="logo d-flex align-items-center">
            <span class="sitename company_name">Impact</span>
          </a>
         <p class="footer_description">Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{route('customer#home')}}">Home</a></li>
            <li><a href="{{route('customer#about')}}">About us</a></li>
            <li><a href="{{route('customer#contact')}}">Contact us</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p class="address"></p>
          <p class="mt-4"><strong>Phone:</strong> <span class="phone">+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span class="email">info@example.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename company_name"></strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  <script src="https://kit.fontawesome.com/10de2103ef.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- Vendor JS Files -->
  <script src="{{asset('asset/customer/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('asset/customer/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('asset/owlcarousel/dist/owl.carousel.min.js')}}"></script>
  <!-- Main JS File -->
  <script src="{{asset('asset/customer/assets/js/main.js')}}"></script>
  <script>
    $(document).ready(function(){
        $.ajax({
            type:'get',
            url:`{{route('auth#getInterface')}}`,
            dataType:'json',
            success:function(data){
                $('.company_name').html(data.company_name);
                $('.address').html(data.company_address);
                $('.phone').html(data.company_phone);
                $('.email').html(data.company_email);
                $('.footer_description').html(data.footer_description);
                if (data.company_logo!=null) {
                    $('.company_logo').html(`<img src="{{asset('storage/interface/${data.company_logo}')}}" alt="">`)
                }
            }
        })

        $cartLength=JSON.parse(localStorage.getItem("cart"));
        if ($cartLength!=null) {
            if ($cartLength.length!=0) {
                $('#cart_nav').html(`
                    Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            ${$cartLength.length}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                `);
            }
        }
    })
</script>
<script>

    let status;
    let body=document.getElementsByTagName('body');
    let table=document.querySelectorAll('table');
    if (sessionStorage.getItem('status')) {
        status=sessionStorage.getItem('status');
        if (status=='light') {
            body[0].classList.remove('dark-mode-variables');
            table.forEach(element => {
                element.classList.remove('table-dark');
            });
            document.getElementById('darkmood').checked=false;
        }else{
            body[0].classList.add('dark-mode-variables');
            table.forEach(element => {
                element.classList.add('table-dark');
            });
            document.getElementById('darkmood').checked=true;
        }
    }else{
        status='light';
        body[0].classList.remove('dark-mode-variables');
    }

    let changemood=function (){
        let table=document.querySelectorAll('.table');
        if (status=='light') {
            body[0].classList.add('dark-mode-variables');
            table.forEach(element => {
                element.classList.add('table-dark');
            });
            status='dark';
        }else{
            body[0].classList.remove('dark-mode-variables');
            table.forEach(element => {
                element.classList.remove('table-dark');
            });
            status='light'
        }
        sessionStorage.setItem("status", status);
    }

</script>
@yield('script')
</body>

</html>
