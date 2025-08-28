@extends('welcome')

@section('title', 'About Us')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-6 text-center">
                <h6 class="text-danger fw-bold text-uppercase">Our Story</h6>
                <h2 class="fw-bold display-5 mb-3">About Us</h2>
                <p class="lead text-muted">Committed to excellence in fire safety and protection</p>
            </div>
        </div>

        <!-- Company Introduction -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
                <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="img-fluid rounded-3 shadow" onerror="this.src='https://via.placeholder.com/600x400?text=About+Us'">
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <h3 class="fw-bold mb-4">Your Trusted Fire Safety Partner</h3>
                <p class="mb-4">
                    <strong>U29100OR2020PTC033405</strong> is an ISO 9001:2015 certified company based in Bhubaneswar,
                    Odisha. We specialize in sales, service, installation, and maintenance of ISI marked fire extinguishers, hydrant
                    systems, smoke detectors, fire alarms, and a wide range of safety and personal protective equipment.
                </p>
                <p>
                    Our clientele spans government, public, and private sector industries, hospitals, institutions, and
                    housing societies. We pride ourselves on delivering only the highest quality products and services to ensure the safety of
                    lives and assets.
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h6 class="text-danger fw-bold text-uppercase">Our Purpose</h6>
                <h2 class="fw-bold mb-0">Mission & Vision</h2>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-3 h-100 mission-card">
                    <div class="card-body p-4 text-center">
                        <div class="icon-circle bg-danger text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Mission</h4>
                        <p class="text-muted">To provide innovative, reliable, and affordable fire safety solutions while maintaining top-tier
                            customer service and technical excellence.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-3 h-100 vision-card">
                    <div class="card-body p-4 text-center">
                        <div class="icon-circle bg-danger text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Vision</h4>
                        <p class="text-muted">To be the most trusted and respected fire safety and equipment provider across India, contributing to
                            a safer tomorrow.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Highlight -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h6 class="text-danger fw-bold text-uppercase">What We Do</h6>
                <h2 class="fw-bold mb-0">Our Core Services</h2>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-3 h-100 service-highlight">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-fire-extinguisher"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Fire Extinguishers</h5>
                        <p class="text-muted mb-0">Sales, Service & Maintenance of ISI marked extinguishers.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-3 h-100 service-highlight">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Alarm Systems</h5>
                        <p class="text-muted mb-0">Installation of fire alarms, smoke detectors, and hydrant systems.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-3 h-100 service-highlight">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Safety Gear</h5>
                        <p class="text-muted mb-0">Supply of helmets, gloves, shoes, face shields, and more.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm rounded-3 h-100 service-highlight">
                    <div class="card-body p-4 text-center">
                        <div class="service-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Custom Solutions</h5>
                        <p class="text-muted mb-0">Customized fire safety plans and equipment based on client needs.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="row">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h6 class="text-danger fw-bold text-uppercase">Our Advantages</h6>
                <h2 class="fw-bold mb-0">Why Choose Us?</h2>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h5 class="fw-bold mb-3">ISO Certified</h5>
                        <p class="text-muted mb-0">We follow ISO 9001:2015 standards ensuring consistent quality in all our products and services.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Client-Centric</h5>
                        <p class="text-muted mb-0">Our priority is building long-term relationships through satisfaction, trust and exceptional service.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-award"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Proven Track Record</h5>
                        <p class="text-muted mb-0">Trusted by hospitals, industries, housing societies, and more across the country.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-circle, .service-icon, .advantage-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .mission-card, .vision-card, .service-highlight, .advantage-card {
            transition: all 0.3s ease;
        }
        
        .mission-card:hover, .vision-card:hover, .service-highlight:hover, .advantage-card:hover {
            transform: translateY(-10px);
        }
    </style>
@endsection
