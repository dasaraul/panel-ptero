<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Pterodactyl') }} - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="#0e4688">

        @include('layouts.scripts')

        @section('scripts')
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('vendor/select2/select2.min.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('vendor/bootstrap/bootstrap.min.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('vendor/adminlte/admin.min.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('vendor/adminlte/colors/skin-blue.min.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('vendor/animate/animate.min.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::css('css/pterodactyl.css?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
            <link rel="stylesheet" href="/css/pterodactyl-modern.css?v={{ time() }}">
            <link rel="stylesheet" href="/css/tama-branding.css?v={{ time() }}">

            <[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        @show
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        
        < VIDEO BACKGROUND -->
        <div id="video-background" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; overflow: hidden;">
            <iframe 
                src="https://www.youtube.com/embed/41cr-O-mW2k?autoplay=1&mute=1&loop=1&playlist=41cr-O-mW2k&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&disablekb=1&fs=0&cc_load_policy=0&quality=medium&enablejsapi=1"
                style="position: absolute; top: 50%; left: 50%; width: 120%; height: 120%; transform: translate(-50%, -50%); filter: brightness(0.6) contrast(1.2) saturate(0.8); border: none; pointer-events: none;"
                frameborder="0" 
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(15, 15, 15, 0.4) 0%, rgba(26, 26, 26, 0.3) 50%, rgba(15, 15, 15, 0.4) 100%);"></div>
        </div>
        
        < VIDEO TOGGLE -->
        <div onclick="toggleVideo()" style="position: fixed; bottom: 20px; right: 20px; width: 50px; height: 50px; background: rgba(0, 0, 0, 0.8); border: 2px solid #00d4ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000; color: #00d4ff; font-size: 18px; transition: all 0.3s ease;">
            <i class="fa fa-eye" id="video-icon"></i>
        </div>

        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('index') }}" class="logo">
                    <span>{{ config('app.name', 'Pterodactyl') }}</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="user-menu">
                                <a href="{{ route('account') }}">
                                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('index') }}" data-toggle="tooltip" data-placement="bottom" title="Exit Admin Control"><i class="fa fa-server"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('auth.logout') }}" id="logoutButton" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="fa fa-sign-out"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="header">BASIC ADMINISTRATION</li>
                        <li class="{{ Route::currentRouteName() !== 'admin.index' ?: 'active' }}">
                            <a href="{{ route('admin.index') }}">
                                <i class="fa fa-home"></i> <span>Overview</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.settings') ?: 'active' }}">
                            <a href="{{ route('admin.settings')}}">
                                <i class="fa fa-wrench"></i> <span>Settings</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.api') ?: 'active' }}">
                            <a href="{{ route('admin.api.index')}}">
                                <i class="fa fa-gamepad"></i> <span>Application API</span>
                            </a>
                        </li>
                        <li class="header">MANAGEMENT</li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.databases') ?: 'active' }}">
                            <a href="{{ route('admin.databases') }}">
                                <i class="fa fa-database"></i> <span>Databases</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.locations') ?: 'active' }}">
                            <a href="{{ route('admin.locations') }}">
                                <i class="fa fa-globe"></i> <span>Locations</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.nodes') ?: 'active' }}">
                            <a href="{{ route('admin.nodes') }}">
                                <i class="fa fa-sitemap"></i> <span>Nodes</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.servers') ?: 'active' }}">
                            <a href="{{ route('admin.servers') }}">
                                <i class="fa fa-server"></i> <span>Servers</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.users') ?: 'active' }}">
                            <a href="{{ route('admin.users') }}">
                                <i class="fa fa-users"></i> <span>Users</span>
                            </a>
                        </li>
                        <li class="header">SERVICE MANAGEMENT</li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.mounts') ?: 'active' }}">
                            <a href="{{ route('admin.mounts') }}">
                                <i class="fa fa-magic"></i> <span>Mounts</span>
                            </a>
                        </li>
                        <li class="{{ ! starts_with(Route::currentRouteName(), 'admin.nests') ?: 'active' }}">
                            <a href="{{ route('admin.nests') }}">
                                <i class="fa fa-th-large"></i> <span>Nests</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    @yield('content-header')
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    There was an error validating the data provided.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach (Alert::getMessages() as $type => $messages)
                                @foreach ($messages as $message)
                                    <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
                                        {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) $message ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right small text-gray" style="margin-right:10px;margin-top:-7px;">
                    <strong><i class="fa fa-fw {{ $appIsGit ? 'fa-git-square' : 'fa-code-fork' }}"></i></strong> {{ $appVersion }}<br />
                    <strong><i class="fa fa-fw fa-clock-o"></i></strong> {{ round(microtime(true) - LARAVEL_START, 3) }}s
                </div>
                Copyright &copy; 2015 - {{ date('Y') }} <a href="https://pterodactyl.io/">Pterodactyl Software</a> | <strong>TAMA EL PABLO</strong>
            </footer>
        </div>
        
        <script>
        let videoOn = true;
        function toggleVideo() {
            const video = document.getElementById('video-background');
            const icon = document.getElementById('video-icon');
            if (videoOn) {
                video.style.display = 'none';
                icon.className = 'fa fa-eye-slash';
                videoOn = false;
            } else {
                video.style.display = 'block';
                icon.className = 'fa fa-eye';
                videoOn = true;
            }
        }
        console.log('🎬 Video background loaded - TAMA EL PABLO');
        </script>
        
        @section('footer-scripts')
            <script src="/js/keyboard.polyfill.js" type="application/javascript"></script>
            <script>keyboardeventKeyPolyfill.polyfill();</script>

            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/jquery/jquery.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/sweetalert/sweetalert.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/bootstrap/bootstrap.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/adminlte/app.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/bootstrap-notify/bootstrap-notify.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('vendor/select2/select2.full.min.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            {## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php) Theme::js('js/admin/functions.js?t={cache-version}') ## 🔧 COMMAND 1: Fix Admin Layout (resources/views/layouts/admin.blade.php)}
            <script src="/js/autocomplete.js" type="application/javascript"></script>

            @if(Auth::user()->root_admin)
                <script>
                    $('#logoutButton').on('click', function (event) {
                        event.preventDefault();
                        var that = this;
                        swal({
                            title: 'Do you want to log out?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Log out'
                        }, function () {
                             $.ajax({
                                type: 'POST',
                                url: '{{ route('auth.logout') }}',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },complete: function () {
                                    window.location.href = '{{route('auth.login')}}';
                                }
                        });
                    });
                });
                </script>
            @endif

            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                })
            </script>
        @show
    </body>
</html>
