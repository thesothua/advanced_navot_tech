@extends('welcome')

@section('title', 'Contact Us')

@section('content')
    <div class="container py-4 py-lg-5">
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-6 text-center">
                <h6 class="text-danger fw-bold text-uppercase">Get In Touch</h6>
                <h2 class="fw-bold display-5 mb-3">Contact Us</h2>
                <p class="lead text-muted">We're here to answer your questions and provide assistance</p>
            </div>
        </div>






        <!-- Page content -->
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-success border-4"
                    role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-4"
                    role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            <div class="row g-4 g-lg-5 px-2 px-md-0">
                <!-- Contact Form -->
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="card border-0 shadow-sm rounded-3 p-3 p-lg-4">
                        {{-- <div class="card-body">
                            <h4 class="fw-bold mb-4">Send Us a Message</h4>

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg rounded-3"
                                        id="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg rounded-3"
                                        id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-4">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control form-control-lg rounded-3"
                                        id="subject" placeholder="Enter your subject" value="{{ old('subject') }}"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea name="message" class="form-control form-control-lg rounded-3" id="message" rows="5"
                                        placeholder="Your message..." required>{{ old('message') }}</textarea>
                                </div>
                                <div class="text-center text-lg-start">
                                    <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div> --}}

                        <div class="card-body">
                            <h4 class="fw-bold mb-4">Send Us a Message</h4>


                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email"
                                        class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                        id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" name="subject"
                                        class="form-control form-control-lg rounded-3 @error('subject') is-invalid @enderror"
                                        id="subject" placeholder="Enter your subject" value="{{ old('subject') }}"
                                        required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea name="message" class="form-control form-control-lg rounded-3 @error('message') is-invalid @enderror"
                                        id="message" rows="5" placeholder="Your message..." required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-center text-lg-start">
                                    <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>

                <!-- Contact Info + Map -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="card border-0 shadow-sm rounded-3 mb-4 p-3 p-lg-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4">Our Office</h4>
                            @if (app(\App\Settings\GeneralSettings::class)->address)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon bg-danger text-white rounded-circle me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Address</h6>
                                        <p class="text-muted mb-0">{{ app(\App\Settings\GeneralSettings::class)->address }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (app(\App\Settings\GeneralSettings::class)->contact_email)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon bg-danger text-white rounded-circle me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Email</h6>
                                        <p class="text-muted mb-0">
                                            <a href="mailto:{{ app(\App\Settings\GeneralSettings::class)->contact_email }}"
                                                class="text-decoration-none text-muted cursor-pointer">
                                                {{ app(\App\Settings\GeneralSettings::class)->contact_email }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (app(\App\Settings\GeneralSettings::class)->contact_phone)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon bg-danger text-white rounded-circle me-3">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Phone</h6>
                                        <p class="text-muted mb-0">
                                            {{ app(\App\Settings\GeneralSettings::class)->contact_phone }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <div class="contact-icon bg-danger text-white rounded-circle me-3">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Working Hours</h6>
                                    <p class="text-muted mb-0">
                                        {{ app(\App\Settings\GeneralSettings::class)->working_hours }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (app(\App\Settings\GeneralSettings::class)->map_embed_url)
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="ratio ratio-16x9">
                                <!-- Replace with your location -->
                                {{-- <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3670.2495061563154!2d72.5512174748261!3d23.0879605138859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e831238329bad%3A0xde66853f796e4777!2sAashray%20Residency!5e0!3m2!1sen!2sin!4v1756590743849!5m2!1sen!2sin"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                <iframe src="{{ app(\App\Settings\GeneralSettings::class)->map_embed_url }}"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Social Links -->
            <div class="text-center mt-5" data-aos="fade-up">
                <h4 class="fw-bold mb-4">Follow Us</h4>
                <div class="social-links">
                    @if (app(\App\Settings\GeneralSettings::class)->facebook_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->facebook_url }}"
                            class="social-link bg-danger text-white text-decoration-none" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->twitter_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->twitter_url }}"
                            class="social-link bg-danger text-white text-decoration-none" target="_blank"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->linkedin_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->linkedin_url }}"
                            class="social-link bg-danger text-white text-decoration-none" target="_blank"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->instagram_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->instagram_url }}"
                            class="social-link bg-danger text-white text-decoration-none" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (app(\App\Settings\GeneralSettings::class)->youtube_url)
                        <a href="{{ app(\App\Settings\GeneralSettings::class)->youtube_url }}"
                            class="social-link bg-danger text-white text-decoration-none" target="_blank"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <style>
            .contact-icon {
                min-width: 45px;
                width: 45px;
                height: 45px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
            }

            @media (max-width: 768px) {
                .contact-icon {
                    min-width: 40px;
                    width: 40px;
                    height: 40px;
                    font-size: 1rem;
                }

                .form-control-lg {
                    font-size: 1rem;
                    padding: 0.5rem 1rem;
                }

                .btn-lg {
                    font-size: 1rem;
                    padding: 0.5rem 1.5rem;
                }

                h2 {
                    font-size: 2rem;
                }

                h4 {
                    font-size: 1.5rem;
                }

                .lead {
                    font-size: 1rem;
                }
            }

            @media (max-width: 576px) {
                .contact-icon {
                    min-width: 35px;
                    width: 35px;
                    height: 35px;
                    font-size: 0.9rem;
                }

                .px-5 {
                    padding-left: 1.5rem !important;
                    padding-right: 1.5rem !important;
                }
            }

            .social-links {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 1rem;
                gap: 15px;
            }

            .social-link {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                transition: all 0.3s ease;
            }

            .social-link:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .form-control {
                border: 1px solid #dee2e6;
                padding: 0.75rem 1.25rem;
            }

            .form-control:focus {
                border-color: var(--bs-danger);
                box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            }
        </style>
    @endsection
