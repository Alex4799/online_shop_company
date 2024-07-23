<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        a{
            text-decoration: none;
            color: black;
        }
        .btn-primary{
            background-color: rgb(8, 104, 247);
            padding: 10px;
            border-radius: 5px;
            color: white;
        }
        .d-flex{
          display: flex;
        }
        .justify-content-center{
          justify-content: center;
        }
        .p-3{
          padding: 3rem;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
