@extends('welcome')

@section('title', 'About Us')

@section('content')
    <div class="container py-4 py-lg-5">
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-6 text-center">
                <h6 class="text-danger fw-bold text-uppercase">Our Story</h6>
                <h2 class="fw-bold display-5 mb-3">About Us</h2>
                <p class="lead text-muted">Committed to excellence in fire safety and protection</p>
            </div>
        </div>

        <!-- Company Introduction -->
        <div class="row align-items-center mb-4 mb-lg-5 px-2 px-md-0">
            <div class="col-lg-6 mb-4 mb-lg-0 px-md-3" data-aos="fade-right" data-aos-delay="100">
                <img src="{{ asset('storage/' . $globalSettings->about_image_2) }}" alt="About Us"
                    class="img-fluid rounded-3" onerror="this.src='https://via.placeholder.com/600x400?text=About+Us'">
                <!-- <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="img-fluid rounded-3 shadow" onerror="this.src='https://via.placeholder.com/600x400?text=About+Us'"> -->
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <h3 class="fw-bold mb-4">AdvancedNova: Certified Safety Equipment & Integrated Protection Systems</h3>
                <p class="mb-4">
                    At AdvancedNova Pvt Ltd, safety isn’t just a standard—it’s our purpose. We are a next-generation
                    occupational safety solutions provider, committed to protecting lives and empowering industries with
                    innovative, certified, and reliable safety equipment. Founded with a vision to redefine workplace
                    safety, AdvancedNova delivers comprehensive, world-class solutions that go beyond products. Our
                    offerings range from head-to-toe Personal Protective Equipment (PPE) to integrated fall protection
                    systems, emergency equipment, and custom-engineered safety solutions designed for high-risk
                    environments. Backed by a team of experienced professionals and a robust manufacturing infrastructure,
                    we ensure every product meets or exceeds international safety standards. Our solutions are trusted
                    across industries where safety is critical—because we believe every worker deserves to go home safe,
                    every single day. But we don’t stop at equipment. Through training, on-ground support, and ongoing
                    innovation, AdvancedNova Pvt Ltd helps organizations build a culture of safety that lasts. With global
                    collaborations and a deep understanding of local challenges, we are here to make workplaces not just
                    compliant—but truly safe and resilient.
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="row mb-4 mb-lg-5 px-2 px-md-0">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h6 class="text-danger fw-bold text-uppercase">Our Purpose</h6>
                <h2 class="fw-bold mb-0">Mission & Vision</h2>
                <p class="text-muted mt-2">
                    At AdvancedNova, safety is more than compliance—it’s our commitment to protect lives and build resilient
                    workplaces.
                </p>
            </div>
            <!-- Mission -->
            <div class="col-md-6 mb-sm-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-3 h-100 mission-card">
                    <div class="card-body p-4 text-center">
                        <div class="icon-circle bg-danger text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-bullseye fa-lg"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Mission</h4>
                        <p class="text-muted">
                            To safeguard every worker by delivering innovative, certified, and reliable safety
                            solutions—empowering industries to create safer, smarter, and stronger workplaces.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Vision -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-3 h-100 vision-card">
                    <div class="card-body p-4 text-center">
                        <div class="icon-circle bg-danger text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-eye fa-lg"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Our Vision</h4>
                        <p class="text-muted">
                            To be the world’s most trusted name in occupational safety—driven by innovation, guided by
                            integrity, and committed to ensuring that every worker goes home safe, every day.
                        </p>
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

        {{-- <!-- Why Choose Us -->
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
                        <p class="text-muted mb-0">We follow ISO 9001:2015 standards ensuring consistent quality in all our
                            products and services.</p>
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
                        <p class="text-muted mb-0">Our priority is building long-term relationships through satisfaction,
                            trust and exceptional service.</p>
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
                        <p class="text-muted mb-0">Trusted by hospitals, industries, housing societies, and more across the
                            country.</p>
                    </div>
                </div>
            </div>
        </div> --}}



        <!-- Why Choose Us -->
        <div class="row">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h6 class="text-danger fw-bold text-uppercase">Our Advantages</h6>
                <h2 class="fw-bold mb-0">Why Choose Us?</h2>
            </div>

            <!-- Item 1 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Globally Certified</h5>
                        <p class="text-muted mb-0">PPE & safety systems that meet international standards for maximum
                            protection.</p>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Tailored Solutions</h5>
                        <p class="text-muted mb-0">Custom-engineered for high-risk environments where safety is critical.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Fall & Emergency Safety</h5>
                        <p class="text-muted mb-0">Industry-leading fall protection systems and emergency equipment you can
                            trust.</p>
                    </div>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Training & Support</h5>
                        <p class="text-muted mb-0">On-site training, expert consulting, and reliable safety support for
                            organizations.</p>
                    </div>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Quality & Innovation</h5>
                        <p class="text-muted mb-0">Solutions built on compliance, quality, and continuous innovation in
                            safety.</p>
                    </div>
                </div>
            </div>

            <!-- Item 6 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card border-0 shadow-sm rounded-3 h-100 advantage-card">
                    <div class="card-body p-4 text-center">
                        <div class="advantage-icon bg-danger text-white rounded-circle mx-auto mb-3">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Trusted Partnerships</h5>
                        <p class="text-muted mb-0">Backed by global collaborations and a strong client network, ensuring
                            reliable safety solutions worldwide.</p>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <style>
        .icon-circle,
        .service-icon,
        .advantage-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {

            .icon-circle,
            .service-icon,
            .advantage-icon {
                width: 60px;
                height: 60px;
                font-size: 1.25rem;
            }
        }

        @media (max-width: 576px) {

            .icon-circle,
            .service-icon,
            .advantage-icon {
                width: 50px;
                height: 50px;
                font-size: 1rem;
            }

            h2 {
                font-size: 2rem;
            }

            h3 {
                font-size: 1.75rem;
            }

            h4 {
                font-size: 1.5rem;
            }

            h5 {
                font-size: 1.25rem;
            }

            .lead {
                font-size: 1rem;
            }
        }

        .mission-card,
        .vision-card,
        .service-highlight,
        .advantage-card {
            transition: all 0.3s ease;
        }

        .mission-card:hover,
        .vision-card:hover,
        .service-highlight:hover,
        .advantage-card:hover {
            transform: translateY(-10px);
        }

        @media (max-width: 768px) {

            .mission-card:hover,
            .vision-card:hover,
            .service-highlight:hover,
            .advantage-card:hover {
                transform: translateY(-5px);
            }
        }

        .card {
            overflow: hidden;
        }

        .card-body {
            z-index: 1;
            position: relative;
        }

        img.img-fluid {
            transition: transform 0.3s ease;
        }

        img.img-fluid:hover {
            transform: scale(1.05);
        }
    </style>
@endsection
