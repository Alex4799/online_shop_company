<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angle</title>
    <link rel="shortcut icon" href="{{asset('asset/image/ANGLE_logo.png')}}" type="image/x-icon">
    <link href="{{asset('asset/admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

</head>
<body class="cover">
    <div class="font-color">
        @yield('content')
    </div>
</body>
<script src="https://kit.fontawesome.com/10de2103ef.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{asset('asset/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    function changeInputType() {
        let input = document.getElementsByClassName('passwordInput');
        for (let i = 0; i < input.length; i++) {
            if (input[i].type === "password") {
                input[i].type = "text";
            } else {
                input[i].type = "password";
            }

        }
    }
</script>
<script>
    $(document).ready(function(){
        $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/get/interface',
            dataType:'json',
            success:function(data){
                $('title').html(data.company_name);
            }
        })
    })
</script>
<script src="{{asset('asset/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@yield('script')
</html>
