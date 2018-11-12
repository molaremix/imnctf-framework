<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/favicon.png')}}">
    <title>{{$about['title'] ?? 'ImnCTF'}}</title>
    <link href="{{asset('/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
         style="background:url({{asset('/img/flag.png')}}) no-repeat center center;">
        <div class="auth-box">
            <div id="loginform">
                <div class="logo">
                    <span class="db"><img src="{{asset('/img/icon-banner.png')}}" alt="logo" style="max-width: 300px"/></span>
                    <h5 class="font-medium m-b-20 mt-3">@yield('title', 'Sign In to Admin')</h5>
                </div>
                @yield('form')
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script>
    $(".preloader").fadeOut();
</script>
<script src="{{asset('/assets/libs/toastr/build/toastr.min.js')}}"></script>
<script>
    $(document).ready(function () {
        @if(Session::has('status'))
        toastr.success('{{Session::get('status')}}', 'Info');
        @endif
    });
</script>
</body>

</html>