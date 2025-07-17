<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Page Title' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('front/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/solid.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="{{asset('front/css/style.css') }}">
    @livewireStyles
</head>

<body>

    <!-- navigation -->
    <header class="navigation bg-tertiary">
        <nav class="navbar navbar-expand-xl navbar-light text-center py-3">
            <div class="container">
                <!-- Logo -->
                <a wire:navigate class="navbar-brand" href="{{ route('home') }}">
                    <img class="img-fluid" width="160" src="{{ asset('front/images/logo.png') }}" alt="Logo">
                </a>

                <!-- Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto mb-2 mb-xl-0">

                        <!-- Home -->
                        <li class="nav-item">
                            <a wire:navigate class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate class="nav-link" href="{{ route('page', ['pageId' => 1]) }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a wire:navigate class="nav-link" href="{{ route('teamPage') }}">Our Team</a>
                        </li>

                        <!-- Company Dropdown -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Company</a>
                            <ul class="dropdown-menu">
                                <li><a wire:navigate class="dropdown-item" href="{{ route('page', ['pageId' => 1]) }}">About Us</a></li>
                                <li><a wire:navigate class="dropdown-item" href="{{ route('teamPage') }}">Our Team</a></li>
                            </ul>
                        </li> -->

                        <!-- Services Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Services</a>
                            <ul class="dropdown-menu">
                                <li><a wire:navigate class="dropdown-item" href="{{ route('servicesPage') }}">All Services</a></li>
                                <li><a wire:navigate class="dropdown-item" href="{{ route('monitoringPage') }}">Extract Monitor</a></li>
                            </ul>
                        </li>

                        <!-- Docs -->
                        <li class="nav-item">
                            <a wire:navigate class="nav-link" href="{{ route('docsPages') }}">Docs</a>
                        </li>

                        <!-- FAQ -->
                        <li class="nav-item">
                            <a wire:navigate class="nav-link" href="{{ route('faqPage') }}">FAQ</a>
                        </li>

                        <!-- Blog (optional) -->
                        <li class="nav-item">
                            <a wire:navigate class="nav-link" href="{{ route('blogPage') }}">Articles</a>
                        </li>
                    </ul>

                    <!-- Contact Button -->
                    <a wire:navigate href="{{ route('contactPage') }}" class="btn btn-outline-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- /navigation -->

    <!-- Konten utama -->
    <div class="container-fluid px-5 py-4">
        {{ $slot }}
    </div>

    <footer class="section-sm bg-tertiary">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="mb-4 text-primary font-secondary">Service</h5>
                        <ul class="list-unstyled">
                            @foreach (getServices() as $service)
                            <li class="mb-2"><a wire:navigate href="{{ route('servicePage', $service->id) }}">{{ $service->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="mb-4 text-primary font-secondary">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a wire:navigate href="{{ route('page', ['pageId' => 1]) }}">About Us</a>
                            </li>
                            <li class="mb-2"><a wire:navigate href="{{ route('contactPage') }}">Contact Us</a>
                            </li>
                            <li class="mb-2"><a wire:navigate href="{{ route('blogPage') }}">Articles</a>
                            </li>
                            <li class="mb-2"><a wire:navigate href="{{ route('teamPage') }}">Team</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="mb-4 text-primary font-secondary">Other Links</h5>
                        <ul class="list-unstyled">
                            <li class="list-inline-item me-4"><a wire:navigate class="text-black" href="{{ route('page', ['pageId' => 2]) }}">Privacy Policy</a>
                            </li>
                            <li class="list-inline-item me-4"><a wire:navigate class="text-black" href="{{ route('page', ['pageId' => 4]) }}">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <!-- # JS Plugins -->
    <!-- # JS Plugins -->
    <script src="{{ asset('front/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/plugins/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Tambahkan ini: Slick Carousel -->
    <script src="{{ asset('front/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('front/plugins/scrollmenu/scrollmenu.min.js') }}"></script>

    <!-- Main Script (yang memanggil .slick()) -->
    <script src="{{ asset('front/js/script.js') }}"></script>

    @livewireScripts

</body>

</html>