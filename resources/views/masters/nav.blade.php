<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>{{env('app_name')}}</title>
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <link href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
    @stack('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
</head>
<body>

<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper">
    <aside class="left-sidebar">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="{{route('index')}}">
                            <span class="hide-menu">{{env('app_name')}} </span>
                        </a>
                    </li>

                    @if(Auth::guard('admin')->check())
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('admin.about.index')}}"
                               aria-expanded="false">
                                <i class="ti-help-alt"></i>
                                <span class="hide-menu">About </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('admin.news.index')}}"
                               aria-expanded="false">
                                <i class="ti-receipt"></i>
                                <span class="hide-menu">News </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                        class="ti-flag-alt-2"></i><span class="hide-menu">Challenges </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{route('admin.challenge.index')}}"
                                                            class="sidebar-link"><span
                                                class="hide-menu"> Challenge </span></a></li>
                                <li class="sidebar-item"><a href="{{route('admin.category.index')}}"
                                                            class="sidebar-link"><span
                                                class="hide-menu"> Categories </span></a></li>
                                <li class="sidebar-item"><a href="{{route('admin.hint.index')}}"
                                                            class="sidebar-link"></i><span
                                                class="hide-menu"> Hints </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('admin.team.index')}}"
                               aria-expanded="false">
                                <i class="icon-people"></i>
                                <span class="hide-menu">Team</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('admin.submission.index')}}"
                               aria-expanded="false">
                                <i class="icon-paper-plane"></i>
                                <span class="hide-menu">Submission</span>
                            </a>
                        </li>
                    @elseif(Auth::guard('team')->check())
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('profile.index')}}"
                               aria-expanded="false">
                                <i class="ti-user"></i>
                                <span class="hide-menu">Profile </span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::guard('admin')->check())
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('scoreboard.index')}}"
                               aria-expanded="false">
                                <i class="ti-cup"></i>
                                <span class="hide-menu">Scoreboard </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('admin.logout')}}"
                               aria-expanded="false">
                                <i class="ti-power-off"></i>
                                <span class="hide-menu">Logout </span>
                            </a>
                        </li>
                    @else
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('news.index')}}"
                               aria-expanded="false">
                                <i class="ti-help-alt"></i>
                                <span class="hide-menu">News </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('challenge.index')}}"
                               aria-expanded="false">
                                <i class="ti-flag-alt-2"></i>
                                <span class="hide-menu">Challenges </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('scoreboard.index')}}"
                               aria-expanded="false">
                                <i class="ti-cup"></i>
                                <span class="hide-menu">Scoreboard </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{route('logout')}}"
                               aria-expanded="false">
                                <i class="ti-power-off"></i>
                                <span class="hide-menu">Logout </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <footer class="footer text-center">
        Powered by <a href="https://github.com/iamnubs/imnctf-framework" target="_blank">ImnCTF</a>.
    </footer>
</div>
<script src="{{asset('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/app.min.js')}}"></script>
<script src="{{asset('/js/app.init.horizontal.js')}}"></script>
<script src="{{asset('/js/app-style-switcher.horizontal.js')}}"></script>
<script src="{{asset('/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<script src="{{asset('/assets/libs/toastr/build/toastr.min.js')}}"></script>
<script src="{{asset('/js/waves.js')}}"></script>
<script src="{{asset('/js/sidebarmenu.js')}}"></script>
<script src="{{asset('/js/custom.min.js')}}"></script>
<script>
    $(document).ready(function () {
        @if(Session::has('status'))
        toastr.success('{{Session::get('status')}}', 'Info');
        @endif
    });
</script>
@stack('scripts')
</body>

</html>