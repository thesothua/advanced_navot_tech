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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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

        body {
            padding-top: 76px;
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 62px;
            }
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: var(--primary-color);
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('logo/mylogo.png') }}" width="40" alt="logo"
                    class="img-fluid rounded shadow-sm me-2">
                <span>Advanced Nova Tech</span>
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


    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container text-md-left">
            <div class="row text-md-left gy-4">

                <!-- Company Info -->
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                    <h5 class="text-uppercase fw-bold text-danger">Fire & Safety Solutions</h5>
                    <p>
                        A professionally managed ISO 9001:2015 certified company in Odisha providing high-quality fire
                        safety products and services to government, public and private sectors.
                    </p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase fw-bold text-danger">Quick Links</h5>
                    <p><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></p>
                    <p><a href="{{ url('/about') }}" class="text-white text-decoration-none">About Us</a></p>
                    <p><a href="{{ url('/products') }}" class="text-white text-decoration-none">Products</a></p>
                    <p><a href="{{ url('/contact') }}" class="text-white text-decoration-none">Contact Us</a></p>
                </div>

                <!-- Services -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase fw-bold text-danger">Our Services</h5>
                    <p class="text-white-50">Fire Extinguishers (CO₂, ABC, DCP)</p>
                    <p class="text-white-50">Fire Alarm Systems</p>
                    <p class="text-white-50">Hydrant Accessories</p>
                    <p class="text-white-50">Safety Equipment & PPEs</p>
                </div>

                <!-- Contact -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase fw-bold text-danger">Contact Us</h5>
                    @if (app(\App\Settings\GeneralSettings::class)->address)
                        <p><i class="fas fa-map-marker-alt me-2"></i>
                            {{ app(\App\Settings\GeneralSettings::class)->address }}</p>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->contact_email)
                        <p><i class="fas fa-envelope me-2"></i>
                            {{ app(\App\Settings\GeneralSettings::class)->contact_email }}</p>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->contact_phone)
                        <p><i class="fas fa-phone me-2"></i>
                            {{ app(\App\Settings\GeneralSettings::class)->contact_phone }}</p>
                    @endif
                    <p><i class="fas fa-clock me-2"></i>{{ app(\App\Settings\GeneralSettings::class)->working_hours }}
                    </p>
                </div>

            </div>

            <hr class="my-4 text-white-50">

            <div class="row align-items-center gy-3">
                <div class="col-md-7 col-lg-8">
                    <p class="text-white-50 mb-0">
                        &copy; {{ now()->year }} Fire & Safety Solutions. All rights reserved.
                    </p>
                </div>

                <div class="col-md-5 col-lg-4 text-md-right">
                    <!-- Social icons -->
                    @if (app(\App\Settings\GeneralSettings::class)->facebook_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->facebook_url }}"
                            class="text-white me-3" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->twitter_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->twitter_url }}"
                            class="text-white me-3" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->linkedin_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->linkedin_url }}"
                            class="text-white me-3" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->instagram_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->instagram_url }}" class="text-white"
                            target="_blank"><i class="fab fa-instagram"></i></a>
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
