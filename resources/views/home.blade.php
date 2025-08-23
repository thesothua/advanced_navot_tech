@extends('welcome')

@section('title', 'Home - Fire & Safety Solutions')

@section('content')
    <!-- Hero Section: Bootstrap Carousel -->
    <section id="hero" class="shadow">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="https://images.pexels.com/photos/176342/pexels-photo-176342.jpeg" class="d-block w-100"
                        style="max-height: 600px; object-fit: cover;" alt="Hero 1">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-4 rounded">
                        <h1 class="display-5 fw-bold">Your Trusted Fire & Safety Partner</h1>
                        <p class="lead">ISO 9000:2015 Certified | ISI & TAC Approved Products</p>
                        <a href="{{ url('/contact') }}" class="btn btn-light btn-lg mt-3">Get a Free Consultation</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg" class="d-block w-100"
                        style="max-height: 600px; object-fit: cover;" alt="Hero 2">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-4 rounded">
                        <h1 class="display-5 fw-bold">Fire Extinguishers & Hydrant Systems</h1>
                        <p class="lead">Sales, Installation & Maintenance by Experts</p>
                        <a href="{{ url('/products') }}" class="btn btn-danger btn-lg mt-3">Explore Products</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/224924/pexels-photo-224924.jpeg" class="d-block w-100"
                        style="max-height: 600px; object-fit: cover;" alt="Hero 3">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-4 rounded">
                        <h1 class="display-5 fw-bold">PPE & Safety Equipment</h1>
                        <p class="lead">Helmets, Gloves, Face Shields, and More</p>
                        <a href="{{ url('/contact') }}" class="btn btn-warning btn-lg mt-3">Get a Quote</a>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- About Section with Icons -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-danger">Who We Are</h2>
                <p class="text-muted">Delivering fire and safety excellence across industries</p>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/fire-safety-about.jpg') }}" class="img-fluid rounded shadow-sm"
                        alt="About Company">
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-4">
                            <i class="fas fa-fire-extinguisher fa-2x text-danger me-3"></i>
                            <span><strong>Certified Provider:</strong> ISO 9000:2015, ISI & TAC approved solutions</span>
                        </li>
                        <li class="mb-4">
                            <i class="fas fa-tools fa-2x text-danger me-3"></i>
                            <span><strong>Full-Service:</strong> Sales, installation, servicing & maintenance</span>
                        </li>
                        <li class="mb-4">
                            <i class="fas fa-users fa-2x text-danger me-3"></i>
                            <span><strong>Clientele:</strong> Serving government, hospitals, housing societies & more</span>
                        </li>
                    </ul>
                    <a href="{{ url('/about') }}" class="btn btn-danger">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold text-danger mb-5">Our Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-fire text-danger fs-1 mb-3"></i>
                            <h5 class="card-title">Fire Extinguishers</h5>
                            <p class="card-text">CO2, Dry Powder, Modular Automatic ABC/BC type extinguishers – ISI marked
                                for every industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-broadcast text-danger fs-1 mb-3"></i>
                            <h5 class="card-title">Alarm & Detection Systems</h5>
                            <p class="card-text">Installation and maintenance of smoke detectors, fire alarms, and complete
                                hydrant systems.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check text-danger fs-1 mb-3"></i>
                            <h5 class="card-title">Safety & PPE Equipment</h5>
                            <p class="card-text">Wide range of ISI-approved PPE – helmets, gloves, goggles, nose masks,
                                safety shoes, face shields, etc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-danger text-white">
        <div class="container text-center">
            <h3 class="fw-bold">Need Reliable Fire & Safety Solutions?</h3>
            <p>Contact us today for customized fire safety audits, installations, and services across India.</p>
            <a href="{{ url('/contact') }}" class="btn btn-light mt-3">Contact Us</a>
        </div>
    </section>
@endsection
