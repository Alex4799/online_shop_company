<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Angle</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('asset/image/ANGLE_logo.png')}}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('asset/admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('asset/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('asset/admin/assets/vendor/boxicons/css/boxicons.min.cs')}}s" rel="stylesheet">
  <link href="{{asset('asset/admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('asset/admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('asset/admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('asset/admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('asset/admin/assets/css/user.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('user#profile')}}" class="logo d-flex align-items-center">
            <div id="logo">
                <img src="{{asset('asset/admin/assets/img/logo.png')}}" alt="">
            </div>
            <span class="d-none d-lg-block" id="company_name"><span class="company_name">NiceAdmin</span> <span>({{Auth::user()->position}})</span></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    {{-- <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown ">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                  <i class="bi bi-bell"></i>
                  <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle alert_dot d-none" id="alert_dot">
                    <span class="visually-hidden">New alerts</span>
                  </span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

                    <li class="dropdown-header"> <span class="alert_dot d-none">You have new notifications</span> </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item supplier d-none" id="supplier_alert">
                        <a href="{{route('admin#supplierList')}}">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                            <h4>Supplier Pending</h4>
                            <p>You have <span id="supplier_count">0</span> supplier pending.</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item message">
                <a class="nav-link nav-icon" href="{{route('admin#messageList','inbox')}}" id="message">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-primary badge-number"></span>
                </a>
            </li>

            <li class="nav-item pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (Auth::user()->image==null)
                        @if (Auth::user()->gender=='female')
                            <img src="{{asset('asset/image/default-female-image.webp')}}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="{{asset('asset/image/default-male-image.png')}}" alt="Profile" class="rounded-circle">
                        @endif
                    @else
                        <img src="{{asset('storage/profile/'.Auth::user()->image)}}" alt="Profile" class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                    <h6>{{Auth::user()->name}}</h6>
                    <span>{{Auth::user()->position}}</span>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{route('admin#profile')}}">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="w-100 py-2 bg-danger"><i class="bi bi-box-arrow-right"></i>Log Out</button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation --> --}}

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center gap-1">

            <li class="nav-item p-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" onclick="changemood()" role="switch" id="darkmood" >
                    <label class="form-check-label" for="darkmood">Dark</label>
                </div>
            </li>

            <li class="nav-item dropdown ">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                  <i class="bi bi-bell"></i>
                  <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle alert_dot d-none" id="alert_dot">
                    <span class="visually-hidden">New alerts</span>
                  </span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

                    <li class="dropdown-header"> <span class="alert_dot d-none">You have new notifications</span> </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item supplier d-none" id="purchase_alert">
                        <a href="{{route('supplier#listPurchase')}}">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                            <h4>Purchase Pending</h4>
                            <p>You have <span id="purchase_count">0</span> purchase pending.</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item supplier d-none" id="order_alert">
                        <a href="{{route('seller#listOrder')}}">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                            <h4>Order Pending</h4>
                            <p>You have <span id="order_count">0</span> order pending.</p>
                            </div>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item message_icon">
                <a class="nav-link nav-icon" href="{{route('user#messageList','inbox')}}" id="message_icon">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-primary badge-number"></span>
                </a>
            </li>

            <li class="nav-item pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (Auth::user()->image==null)
                        @if (Auth::user()->gender=='female')
                            <img src="{{asset('asset/image/default-female-image.webp')}}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="{{asset('asset/image/default-male-image.png')}}" alt="Profile" class="rounded-circle">
                        @endif
                    @else
                        <img src="{{asset('storage/profile/'.Auth::user()->image)}}" alt="Profile" class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                    <h6>{{Auth::user()->name}}</h6>
                    <span>{{Auth::user()->position}}</span>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{route('admin#profile')}}">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{route('logout')}}" method="post" id="logout">
                            @csrf
                            <button type="button" id="logOutBtn" class="w-100 py-2 bg-danger"><i class="bi bi-box-arrow-right"></i>Log Out</button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->


    @include('main.user.layout.sidebar')

    <main id="main" class="main">
        @yield('content')
    </main>

    @include('main.user.layout.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://kit.fontawesome.com/10de2103ef.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- Vendor JS Files -->
  <script src="{{asset('asset/admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('asset/admin/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('asset/admin/assets/js/main.js')}}"></script>
  <script>
        $(document).ready(function(){
        $.ajax({
            type:'get',
            url:`{{route('auth#getInterface')}}`,
            dataType:'json',
            success:function(data){
                $('.company_name').html(data.company_name);
                if (data.company_logo!=null) {
                    $('#logo').html(`<img src="{{asset('storage/interface/${data.company_logo}')}}" alt="" class="w-100 img-thumbnail">`);
                }
            }
        });
        $.ajax({
            type:'get',
            url:`{{route('getMessage')}}`,
            dataType:'json',
            success:function(data){
                if (data.length!=0) {
                    $('#message_icon').html(`
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-primary badge-number">${data.length}</span>
                    `)
                }
            }
        });
        $.ajax({
            type:'get',
            url:`{{route('user#getPurchaseinterface')}}`,
            dataType:'json',
            success:function(data){
                if (data.length!=0) {
                    $('.alert_dot').removeClass('d-none');
                    $('#purchase_alert').removeClass('d-none');
                    $('#purchase_count').html(data.length);
                }
            }
        });
        $.ajax({
            type:'get',
            url:`{{route('user#getOrderinterface')}}`,
            dataType:'json',
            success:function(data){
                if (data.length!=0) {
                    $('.alert_dot').removeClass('d-none');
                    $('#order_alert').removeClass('d-none');
                    $('#order_count').html(data.length);
                }
            }
        });

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
    <script>
        $('document').ready(function(){
            $('#logOutBtn').click(function(){
                $.ajax({
                type:'get',
                url:`{{route('notActive')}}`,
                dataType:'json',
                success:function(data){
                    if (data.status=='successful') {
                        $('#logout').submit();
                    }

                }
            })
            })
        })
    </script>
  @yield('script')
</body>

</html>
