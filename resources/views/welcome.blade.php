<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - MySite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm fixed-top py-3 mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="/">
               <img src="{{ asset('logo/mylogo.png') }}" width="40" alt="logo" class="img-fluid rounded shadow-sm"> <i class="bi bi-shield-shaded me-2"></i>Advanced Nova Tech
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">

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
                        <a class="nav-link dropdown-toggle {{ request()->is('category/*') || request()->is('products') ? 'active fw-semibold text-white' : 'text-white-50' }}"
                            href="{{ url('/products') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 border-0 shadow-sm"
                            aria-labelledby="navbarDropdown">
                            @forelse($categories ?? [] as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ url('/categories/' . $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
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

                </ul>
            </div>
        </div>
    </nav>


    <!-- Page Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container text-md-left">
            <div class="row text-md-left">

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
                    <p><i class="fas fa-map-marker-alt me-2"></i> Bhubaneswar, Odisha, India</p>
                    <p><i class="fas fa-envelope me-2"></i> support@firesafety.com</p>
                    <p><i class="fas fa-phone me-2"></i> +91 98765 43210</p>
                    <p><i class="fas fa-clock me-2"></i> Mon - Sat: 9:00 AM – 6:00 PM</p>
                </div>

            </div>

            <hr class="my-4 text-white-50">

            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="text-white-50 mb-0">
                        &copy; {{ now()->year }} Fire & Safety Solutions. All rights reserved.
                    </p>
                </div>

                <div class="col-md-5 col-lg-4 text-md-right">
                    <!-- Social icons -->
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
            
            // Debug log
            console.log('Dropdowns initialized:', dropdownList.length);
        });
    </script>
    


</body>

</html>
