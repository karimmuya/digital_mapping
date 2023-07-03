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
    <link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital mapping</title>
</head>

<style>
    body {
        background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
        }
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        padding: 58px 0 0;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        width: 240px;
        z-index: 600;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            width: 100%;
        }
    }

    .sidebar .active {
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto;

    }
</style>
<title>Difital Mapping | Admin </title>
</head>

<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-dark  fixed-top py-3">
            <div class="container-fluid ">
                <a class="navbar-brand text-light" href="/admin" style=""><strong>Digital Mapping Admin</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item  shadow-box-example mr-2 z-depth-5 ">
                            <a class="nav-link text-light" href="/">Home</a>
                        </li>
                        @if (Auth::user())
                            <form method="POST" action="/logout">
                                @csrf
                                <li class="nav-item shadow-box-example  z-depth-5 ">
                                    <a class="nav-link text-light" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">Logout</a>
                                </li>
                            </form>
                        @else
                            <li class="nav-item shadow-box-example  z-depth-5 ">
                                <a class="nav-link  text-light " href="/login">Login</a>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>
        </nav>


        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-dark ">
            <div class="position-sticky ">
                <div class="list-group  list-group-flush mx-3 mt-4">
                    <a href="/admin" class="list-group-item list-group-item-action py-3 bg-dark ripple hoverable"
                        aria-current="true">
                        <i class="fas fa-tachometer-alt text-light text-light fa-fw me-3"></i><span class="text-light">
                            Main dashboard</span>
                    </a>

                    <a href="/manage_lands"
                        class="list-group-item list-group-item-action py-3 bg-dark  ripple hoverable"
                        aria-current="true">
                        <i class="fas fa-blog text-light fa-fw me-3"></i><span class="text-light"> Manage Lands</span>
                    </a>

                    <a href="/manage_users"
                        class="list-group-item list-group-item-action py-3 bg-dark  ripple hoverable"
                        aria-current="true">
                        <i class="fas fa-user text-light fa-fw me-3"></i><span class="text-light"> Manage Users</span>
                    </a>

                    <a href="/manage_portions"
                        class="list-group-item list-group-item-action py-3 bg-dark  ripple hoverable"
                        aria-current="true">
                        <i class="fas fa-book text-light fa-fw me-3"></i><span class="text-light"> Manage
                            Portions</span>
                    </a>
                    <a href="/manage_payments"
                        class="list-group-item list-group-item-action py-3 bg-dark  ripple hoverable"
                        aria-current="true">
                        <i class="fas fa-money text-light fa-fw me-3"></i><span class="text-light"> Manage Payments
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="mx-auto" style="margin-top: 95px; width:97%">

        @yield('content')

    </main>

    {{-- <footer class="text-center row col-md-10 mx-auto" style="margin-top: 100px">
        <div class="p-4 mx-auto" style="text-align: center">
            © 2022 H&L
        </div>
    </footer> --}}

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>


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

    {{-- <script>
        $(function() {
   
            $('.datepicker${pid}').datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(dateText) {
                    $('.datepicker${pid}').val(dateText);
                }
            });

         
            $('.datepicker${pid}').click(function() {
                $('.datepicker${pid}').datepicker('show');
            });
        });


        
    </script> --}}


    <script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd 23:59:59'
            });

        $('tr').click(function() {
            var row = $(this).data('row');
            var inputField = $('#datepicker-' + row);
            inputField.datepicker('show');
        });
    });
</script>

</body>

</html>
