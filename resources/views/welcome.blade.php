<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - {{ $globalSettings->site_name ?? config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Description -->
    @if ($globalSettings->site_description ?? false)
        <meta name="description" content="{{ $globalSettings->site_description }}">
    @endif

    <!-- Favicon -->
    @if ($globalSettings->favicon ?? false)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $globalSettings->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif


    <!-- Google Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  --}}

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&family=Source+Sans+Pro&family=Noto+Sans&family=Lato&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #dc3545;
            --secondary-color: #212529;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --transition: all 0.3s ease;
        }


        /* ====================== new css ========================= */
        .bg-danger,
        .btn-danger {
            background-color: #0a192f !important;
            border: none !important;

        }

        .bg-gradient-danger {
            background: linear-gradient(90deg, #0a192f 0%, #122a4f 100%) !important;
        }

        .btn-outline-danger {
            border-color: #0a192f !important;
            color: #0a192f !important;
        }
        
        .btn-outline-danger:hover {
            background-color: #0a192f !important;
            color: #fff !important;
        } 

        .text-uppercase {
            color: #0a192f !important;
        }

        .footer-bg {
            background: linear-gradient(90deg, #0a192f 0%, #122a4f 100%) !important;
        }

        .footer-heading {
            color: #FFFF !important;
        }

        /* ======================= new css end ========================= */

        body {
            /* padding-top: 76px; */
            /* font-family: "sans-serif"; */

            font-family:  "Lato", sans-serif;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            body {
                /* padding-top: 62px; */
            }
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                /* background: var(--primary-color); */
                background: #0a192f;
                padding: 1rem;
                border-radius: 8px;
                margin-top: 0.5rem;
            }

            .navbar-nav .nav-item {
                margin: 0.5rem 0;
            }
        }

        .navbar-brand {
            font-weight: 700;
        }

        .nav-link {
            font-weight: 500;
            position: relative;
            transition: var(--transition);
        }

        .nav-link {
            transition: color var(--transition);
        }

        .nav-link:hover,
        .nav-link.active {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn {
            border-radius: 4px;
            padding: 8px 20px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-danger {
            background-color: var(--primary-color);
        }

        .card {
            border-radius: 8px;
            overflow: hidden;
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Dropdown submenu styles */
        .dropdown-submenu {
            position: relative;
        }

        @media (min-width: 992px) {
            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                display: none;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                display: block;
            }
        }

        @media (max-width: 991px) {
            .dropdown-submenu>.dropdown-menu {
                position: static;
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                background-color: transparent;
            }

            .dropdown-menu {
                background-color: transparent;
                border: none;
                padding-left: 20px;
            }

            .dropdown-item {
                color: rgba(255, 255, 255, 0.7);
                padding: 0.5rem 1rem;
            }

            .dropdown-item:hover {
                color: #fff;
                background-color: transparent;
            }
        }

        /* Arrow for dropdown submenu */
        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        /* ------------- */
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger stiky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('storage/' . $globalSettings->logo) }}" style="max-width: 100px; max-height: 50px;"
                    alt="logo" class="img-fluid rounded shadow-sm me-2">
                {{-- <span>Advanced Nova Tech</span> --}}
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3">

                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-semibold text-white' : 'text-white-50' }}"
                            href="/">Home</a>
                    </li>

                    <!-- About -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active fw-semibold text-white' : 'text-white-50' }}"
                            href="{{ url('/about') }}">About Us</a>
                    </li>


                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('categories/*') || request()->is('products') ? 'active fw-semibold text-white' : 'text-white-50' }}"
                            href="{{ url('/products') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 border-0 shadow-lg rounded-3"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item fw-medium" href="{{ url('/products') }}">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @forelse($categories ?? [] as $category)
                                @if ($category->parent_id === null)
                                    @if ($category->children->count() > 0)
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                                href="{{ url('/categories/' . $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3">
                                                @foreach ($category->children as $subcategory)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/categories/' . $subcategory->slug) }}">
                                                            {{ $subcategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ url('/categories/' . $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @empty
                                <li><span class="dropdown-item text-muted">No categories</span></li>
                            @endforelse
                        </ul>
                    </li>

                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active fw-semibold text-white' : 'text-white-50' }}"
                            href="{{ url('/contact') }}">Contact Us</a>
                    </li>

                    <!-- Login/Admin Button -->
                    <li class="nav-item ms-lg-2">
                        @auth
                            <a href="{{ url('/admin') }}" class="btn btn-sm btn-light fw-medium"><i
                                    class="fas fa-user-shield me-1"></i> Admin Panel</a>
                        @else
                            <!-- <a href="{{ route('login') }}" class="btn btn-sm btn-light fw-medium"><i class="fas fa-sign-in-alt me-1"></i> Login</a> -->
                        @endauth
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <style>
        @media (min-width: 768px) and (max-width: 900px) {
            main {
                overflow-x: hidden;
                max-width: 100vw;
            }

            /* .main-content {
                padding-right: 15px;
                padding-left: 15px;
            } */

            img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
    <!-- Page Content -->
    <main>
        <div class="main-content">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <style>
        @media (min-width: 768px) and (max-width: 900px) {
            .footer-container {
                padding-right: 15px;
                padding-left: 15px;
            }

            .footer-row {
                margin-right: 0;
                margin-left: 0;
            }
        }
    </style>
    <footer class="bg-dark footer-bg text-white pt-5 pb-4 mt-5">
        <div class="container footer-container">
            <div class="row footer-row gy-4">


                <!-- Company Info -->
                <div class="col-md-4 col-lg-4">
                    <h5 class="text-uppercase fw-bold text-danger border-bottom pb-2 footer-heading">AdvancedNova Pvt Ltd</h5>
                    <p class="text-white-50 mt-3">
                        {{ app(\App\Settings\GeneralSettings::class)->footer_description ?? '' }}
                    </p>
                    <p class="text-white-50 mb-0"><em>"Every person deserves to go home safe, every single day."</em>
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2 col-lg-2">
                    <h5 class="text-uppercase fw-bold text-danger border-bottom pb-2 footer-heading">Quick Links</h5>
                    <ul class="list-unstyled mt-3">
                        <li><a href="{{ url('/') }}"
                                class="text-white-50 text-decoration-none d-block mb-2">Home</a></li>
                        <li><a href="{{ url('/about') }}" class="text-white-50 text-decoration-none d-block mb-2">About
                                Us</a></li>
                        <li><a href="{{ url('/products') }}"
                                class="text-white-50 text-decoration-none d-block mb-2">Products</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-white-50 text-decoration-none d-block">Contact
                                Us</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-md-3 col-lg-3">
                    <h5 class="text-uppercase fw-bold text-danger border-bottom pb-2 footer-heading">Our Solutions</h5>
                    <ul class="list-unstyled mt-3 text-white-50">
                        <li class="mb-2">✔️ Certified PPE & Safety Equipment</li>
                        <li class="mb-2">✔️ Fire Extinguishers & Alarm Systems</li>
                        <li class="mb-2">✔️ Fall Protection & Emergency Equipment</li>
                        <li class="mb-2">✔️ Hydrant Systems & Accessories</li>
                        <li class="mb-2">✔️ On-Site Training & Safety Consulting</li>
                        <li>✔️ Custom Safety Solutions</li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-3 col-lg-3">
                    <h5 class="text-uppercase fw-bold text-danger border-bottom pb-2 footer-heading">Contact Us</h5>
                    <ul class="list-unstyled mt-3 text-white-50">
                        @if (app(\App\Settings\GeneralSettings::class)->address)
                            <li class="mb-2"><i
                                    class="fas fa-map-marker-alt me-2"></i>{{ app(\App\Settings\GeneralSettings::class)->address }}
                            </li>
                        @endif
                        @if (app(\App\Settings\GeneralSettings::class)->contact_email)
                            <li class="mb-2"><i
                                    class="fas fa-envelope me-2"></i>{{ app(\App\Settings\GeneralSettings::class)->contact_email }}
                            </li>
                        @endif
                        @if (app(\App\Settings\GeneralSettings::class)->contact_phone)
                            <li class="mb-2">
                                @php
                                    $phones = explode(',', app(\App\Settings\GeneralSettings::class)->contact_phone);
                                @endphp

                                @foreach ($phones as $phone)
                                    <div>
                                        <i class="fas fa-phone me-2"></i> {{ trim($phone) }}
                                    </div>
                                @endforeach
                            </li>
                        @endif
                        <li><i
                                class="fas fa-clock me-2"></i>{{ app(\App\Settings\GeneralSettings::class)->working_hours }}
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 text-white-50">

            <!-- Bottom Row -->
            <div class="row align-items-center gy-3">
                <div class="col-md-7 col-lg-8">
                    <p class="text-white-50 mb-0">
                        &copy; {{ now()->year }} <strong>AdvancedNova Pvt Ltd</strong>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-5 col-lg-4 text-md-end">
                    <!-- Social icons -->
                    @if (app(\App\Settings\GeneralSettings::class)->facebook_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->facebook_url }}"
                            class="text-white-50 me-3 fs-5" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->twitter_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->twitter_url }}"
                            class="text-white-50 me-3 fs-5" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->linkedin_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->linkedin_url }}"
                            class="text-white-50 me-3 fs-5" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->instagram_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->instagram_url }}"
                            class="text-white-50 fs-5 me-3" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->youtube_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->youtube_url }}"
                            class="text-white-50 fs-5" target="_blank"><i class="fab fa-youtube"></i></a>   
                    @endif
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation Library JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });

            // Handle submenu dropdowns on mobile
            document.querySelectorAll('.dropdown-submenu > a').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    // Only prevent default for mobile view
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Toggle the submenu
                        var submenu = this.nextElementSibling;
                        if (submenu && submenu.classList.contains('dropdown-menu')) {
                            if (submenu.style.display === 'block') {
                                submenu.style.display = 'none';
                            } else {
                                submenu.style.display = 'block';
                            }
                        }
                    }
                });
            });

            // Initialize AOS animations
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            // Add smooth scrolling to all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>



</body>

</html>
