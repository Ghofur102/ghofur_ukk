<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GG</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('revolve/images/favicon.ico') }}" type="image/x-icon">

    <!-- THEME CSS
 ================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('revolve/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Themify -->
    <link rel="stylesheet" href="{{ asset('revolve/plugins/themify/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('revolve/plugins/slick-carousel/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('revolve/plugins/slick-carousel/slick.css') }}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="{{ asset('revolve/plugins/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('revolve/plugins/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('revolve/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- manin stylesheet -->
    <link rel="stylesheet" href="{{ asset('revolve/css/style.css') }}">
    <!-- izitoastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <style>
        .text-primary {
            color: #ce8460!important;
        }
    </style>
</head>

<body>
    <header class="header-top bg-grey justify-content-center py-2 d-lg-none">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navigation-2 navigation">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('revolve/images/logo.png') }}" alt="" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                    aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul id="menu" class="menu navbar-nav mx-auto">
                        <li class="nav-item"><a href="/" class="nav-link {{ request()->is('/') ? 'text-primary' : '' }}">Home</a></li>
                        <li class="nav-item"><a href="/gallery/all" class="nav-link {{ request()->is('gallery/all') ? 'text-primary' : '' }}">Gallery</a></li>
                        @auth
                            <li class="nav-item"><a href="/your-gallery" class="nav-link {{ request()->is('your-gallery') ? 'text-primary' : '' }} ">Your Gallery</a></li>
                            <li class="nav-item"><a href="/your-albums" class="nav-link {{ request()->is('your-albums') ? 'text-primary' : '' }}">Your Albums</a></li>
                            <li class="nav-item"><a href="/profile" class="nav-link {{ request()->is('profile') ? 'text-primary' : '' }}">Profile</a></li>
                            <li class="nav-item">
                                <div class="">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Logout</button>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="section-padding pb-0">
        <div class="sidebar d-none d-lg-block">
            <div class="sidebar-sticky">
                <div class="logo-wrapper">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('revolve/images/logo.png') }}" alt="" class="img-fluid">
                    </a>
                </div>

                <div class="main-menu">
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="navbar-collapse collapse" id="navbarsExample09" style="">
                            <ul class="list-unstyled ">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'text-primary' : '' }}" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('gallery/all') ? 'text-primary' : '' }}" href="/gallery/all">Gallery</a>
                                </li>
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('your-gallery') ? 'text-primary' : '' }}" href="/your-gallery">Your Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('your-albums') ? 'text-primary' : '' }}" href="/your-albums">Your Albums</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('profile') ? 'text-primary' : '' }}" href="/profile">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Logout</button>
                                            </form>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="/login">Login</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </div>

            </div>

        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>


    </div>



    <!-- THEME JAVASCRIPT FILES
================================================== -->
    <!-- initialize jQuery Library -->
    <script src="{{ asset('revolve/plugins/jquery/jquery.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- Bootstrap jQuery -->
    <script src="{{ asset('revolve/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('revolve/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Owl caeousel -->
    <script src="{{ asset('revolve/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('revolve/plugins/slick-carousel/slick.min.js') }}"></script>
    <script src="{{ asset('revolve/plugins/magnific-popup/magnific-popup.js') }}"></script>
    <!-- Instagram Feed Js -->
    <script src="{{ asset('revolve/plugins/instafeed-js/instafeed.min.js') }}"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script src="{{ asset('revolve/plugins/google-map/gmap.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('revolve/js/custom.js') }}"></script>
    <!-- izitoast js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script>
        @if (session('success'))
            iziToast.success({
                title: 'Success!',
                message: "{{ session('success') }}",
                position: 'topCenter'
            });
        @endif
        @if (session('error'))
            iziToast.error({
                title: 'Error!',
                message: "{{ session('error') }}",
                position: 'topCenter'
            });
        @endif
    </script>
</body>

</html>
