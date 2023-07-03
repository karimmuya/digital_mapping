<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations-extended.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital mapping</title>
</head>

<body class="homepage-v2 hidden-sn white-skin animated">
    <header>
        <div id="slide-out" class="side-nav sn-bg-4">
            <ul class="custom-scrollbar">
                <li class="logo-sn waves-effect py-3">
                    <div class="text-center"> <a href="#" class="pl-0"><img style="width: 70px;"
                                src="https://www.udsm.ac.tz/web/themes/udsm/layouts/main/img/logo_ud.png" /></a> </div>
                </li>
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li> <a href="/" class="collapsible-header waves-effect"><i
                                    class="w-fa fas fa-home"></i>Home</a>
                        </li>
                        @if (Auth::user())
                            <li> <a href="{{ url('/profile#panel2') }}" class="collapsible-header waves-effect"><i
                                        class="w-fa fas fa-map"></i>My
                                    Properties</a> </li>


                            @if (Auth::user()->is_admin == 1)
                                <li> <a href="" class="collapsible-header waves-effect"><i
                                            class="w-fa fas fa-upload"></i>Upload
                                        Property</a> </li>
                </li>
                @endif
                @endif

                <li> <a href="" class="collapsible-header waves-effect"><i
                            class="w-fa fas fa-question"></i>Help</a> </li>
                </li>
            </ul>

            <div class="sidenav-bg mask-strong"></div>
        </div>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar white">
            <div class="container">
                <div class="float-left mr-2"> <a href="#" data-activates="slide-out" class="button-collapse"><i
                            class="fas fa-bars"></i></a> </div> <a class="navbar-brand font-weight-bold"
                    href="#"><strong>Digital Mapping</strong></a> <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation"> <span
                        class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::user())
                            @php
                                $notifications = \App\Models\Notification::where('user_id', Auth::user()->id)->paginate(3);
                                $num = count($notifications);
                                
                            @endphp

                            @if (Auth::user()->is_admin == '1')
                                <li class="nav-item  mx-3">
                                    <a class="nav-link  dark-grey-text font-weight-bold btn btn-sm btn-primary"
                                        href="/admin"> Admin Panel </a>
                                </li>
                            @endif

                            <li class="nav-item dropdown notifications-nav"> <a
                                    class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span
                                        class="badge red">{{ $num }}</span> <i
                                        class="fas fa-bell blue-text"></i> <span
                                        class="dark-grey-text font-weight-bold ">Notifications</span> </a>

                                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                    @foreach ($notifications as $notification)
                                        <a class="dropdown-item" href="/profile#panel4"> <i
                                                class="far fa-money-bill-alt mr-2" aria-hidden="true"></i>
                                            <span>{{ $notification->title }}</span> <span class="float-right"><i
                                                    class="far fa-clock" aria-hidden="true"></i>
                                                {{ $notification->created_at->diffForHumans() }}</span> </a> </a>
                                    @endforeach
                                </div>

                            </li>
                        @endif
                        <li class="nav-item dropdown ml-3">
                            @if (Auth::user())
                                <a class="nav-link dropdown-toggle dark-grey-text font-weight-bold"
                                    id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fas fa-user blue-text"></i> {{ Auth::user()->name }}
                                </a>
                            @else
                                <a class="nav-link dropdown-toggle dark-grey-text font-weight-bold"
                                    id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="fas fa-user blue-text"></i> Profile </a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-right dropdown-cyan"
                                aria-labelledby="navbarDropdownMenuLink-4">
                                @if (Auth::user())
                                    <a class="dropdown-item waves-effect waves-light" href="/profile">My account</a>
                                    <a class="dropdown-item waves-effect waves-light" href="{{ route('logout') }} "
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="/logout" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @else
                                    <a class="dropdown-item waves-effect waves-light"
                                        href="{{ route('login') }}">Login</a>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class=" text-center text-md-left  pt-0 ">
        <div class="footer-copyright py-3 text-center">
            <div class="container-fluid"> © 2023 Digital. M </a> </div>
        </div>
    </footer>

    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>


    <script>
        new WOW().init();
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>

    <script>
        $(".button-collapse").sideNav();
        var container = document.querySelector(".custom-scrollbar");
        var ps = new PerfectScrollbar(container, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20,
        });
        $("#btnTopLeft").on("click");
    </script>

    <script>
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%H:%M:%S | %D Days'));
            });
        });
    </script>



    <script>
        $(document).ready(function() {

            var fragment = window.location.hash;
            if (fragment && $(fragment).hasClass('tab-pane')) {
                $('.tab-pane').removeClass('show active');
                $(fragment).addClass('show active');
            }
        });
    </script>

</body>

</html>
