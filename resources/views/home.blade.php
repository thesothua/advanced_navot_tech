@extends('welcome')

@section('title', 'Home - Advanced Nova Tech')

@section('content')
    <!-- Hero Section: Bootstrap Carousel -->
    <section id="hero" class="position-relative">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.pexels.com/photos/176342/pexels-photo-176342.jpeg" class="d-block w-100"
                        style="height: 80vh; object-fit: cover;" alt="Hero 1">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 text-start" data-aos="fade-right">
                                    <h1 class="display-4 fw-bold text-white mb-3">Your Trusted Fire & Safety Partner</h1>
                                    <p class="lead mb-4">ISO 9000:2015 Certified | ISI & TAC Approved Products</p>
                                    <a href="{{ url('/contact') }}" class="btn btn-light btn-lg me-2">Get a Free Consultation</a>
                                    <a href="{{ url('/products') }}" class="btn btn-outline-light btn-lg">Our Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-overlay"></div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg" class="d-block w-100"
                        style="height: 80vh; object-fit: cover;" alt="Hero 2">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 text-start" data-aos="fade-right">
                                    <h1 class="display-4 fw-bold text-white mb-3">Fire Extinguishers & Hydrant Systems</h1>
                                    <p class="lead mb-4">Sales, Installation & Maintenance by Experts</p>
                                    <a href="{{ url('/products') }}" class="btn btn-danger btn-lg me-2">Explore Products</a>
                                    <a href="{{ url('/contact') }}" class="btn btn-outline-light btn-lg">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-overlay"></div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/224924/pexels-photo-224924.jpeg" class="d-block w-100"
                        style="height: 80vh; object-fit: cover;" alt="Hero 3">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 text-start" data-aos="fade-right">
                                    <h1 class="display-4 fw-bold text-white mb-3">PPE & Safety Equipment</h1>
                                    <p class="lead mb-4">Helmets, Gloves, Face Shields, and More</p>
                                    <a href="{{ url('/contact') }}" class="btn btn-warning btn-lg me-2">Get a Quote</a>
                                    <a href="{{ url('/products') }}" class="btn btn-outline-light btn-lg">Browse Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-overlay"></div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    
    <style>
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
        }
        
        .carousel-caption {
            top: 50%;
            transform: translateY(-50%);
            bottom: auto;
            text-align: left;
        }
    </style>

    <!-- About Section with Icons -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-6 text-center">
                    <h6 class="text-danger fw-bold text-uppercase">About Us</h6>
                    <h2 class="fw-bold display-5 mb-3">Who We Are</h2>
                    <p class="text-muted lead">Delivering fire and safety excellence across industries</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{ asset('images/fire-safety-about.jpg') }}" class="img-fluid rounded-3 shadow"
                        alt="About Company" onerror="this.src='https://via.placeholder.com/600x400?text=About+Us'">
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="d-flex align-items-start mb-4">
                        <div class="feature-icon bg-danger text-white rounded-circle p-3 me-4">
                            <i class="fas fa-fire-extinguisher"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Certified Provider</h5>
                            <p class="text-muted">ISO 9000:2015, ISI & TAC approved solutions for maximum reliability and compliance.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <div class="feature-icon bg-danger text-white rounded-circle p-3 me-4">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Full-Service</h5>
                            <p class="text-muted">Complete sales, installation, servicing & maintenance by trained professionals.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <div class="feature-icon bg-danger text-white rounded-circle p-3 me-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Diverse Clientele</h5>
                            <p class="text-muted">Serving government, hospitals, housing societies & more across the country.</p>
                        </div>
                    </div>
                    <a href="{{ url('/about') }}" class="btn btn-danger btn-lg mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-6 text-center">
                    <h6 class="text-danger fw-bold text-uppercase">What We Offer</h6>
                    <h2 class="fw-bold display-5 mb-3">Our Services</h2>
                    <p class="text-muted lead">Comprehensive fire safety solutions for all your needs</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm rounded-3 service-card">
                        <div class="card-body p-4 text-center">
                            <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-4">
                                <i class="fas fa-fire-extinguisher"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Fire Extinguishers</h4>
                            <p class="card-text text-muted">CO2, Dry Powder, Modular Automatic ABC/BC type extinguishers – ISI marked
                                for every industry.</p>
                            <a href="{{ url('/products') }}" class="btn btn-outline-danger mt-3">View Products</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow-sm rounded-3 service-card">
                        <div class="card-body p-4 text-center">
                            <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-4">
                                <i class="fas fa-bell"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Alarm & Detection</h4>
                            <p class="card-text text-muted">Installation and maintenance of smoke detectors, fire alarms, and complete
                                hydrant systems.</p>
                            <a href="{{ url('/products') }}" class="btn btn-outline-danger mt-3">View Products</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 border-0 shadow-sm rounded-3 service-card">
                        <div class="card-body p-4 text-center">
                            <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-4">
                                <i class="fas fa-hard-hat"></i>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Safety & PPE</h4>
                            <p class="card-text text-muted">Wide range of ISI-approved PPE – helmets, gloves, goggles, nose masks,
                                safety shoes, face shields, etc.</p>
                            <a href="{{ url('/products') }}" class="btn btn-outline-danger mt-3">View Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .feature-icon, .service-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        
        .service-card {
            transition: all 0.3s ease;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
    </style>

    <!-- Call to Action Section -->
    <section class="py-5 bg-gradient-danger text-white">
        <div class="container py-4">
            <div class="row align-items-center" data-aos="fade-up">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h2 class="fw-bold display-5 mb-3">Ready to enhance your fire safety?</h2>
                    <p class="lead mb-0">Contact us today for a free consultation and personalized quote for your specific needs.</p>
                </div>
                <div class="col-lg-5 text-center text-lg-end">
                    <a href="{{ url('/contact') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold">Get Free Consultation</a>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        .bg-gradient-danger {
            background: linear-gradient(135deg, var(--bs-danger) 0%, #ff6a5a 100%);
        }
    </style>
@endsection
