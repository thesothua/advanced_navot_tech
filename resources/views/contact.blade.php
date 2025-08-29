@extends('welcome')

@section('title', 'Contact Us')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-6 text-center">
                <h6 class="text-danger fw-bold text-uppercase">Get In Touch</h6>
                <h2 class="fw-bold display-5 mb-3">Contact Us</h2>
                <p class="lead text-muted">We're here to answer your questions and provide assistance</p>
            </div>
        </div>

        <div class="row g-5">
            <!-- Contact Form -->
       <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
    <div class="card border-0 shadow-sm rounded-3 p-4">
        <div class="card-body">
            <h4 class="fw-bold mb-4">Send Us a Message</h4>

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control form-control-lg rounded-3" id="name"
                        placeholder="Enter your name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg rounded-3" id="email"
                        placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control form-control-lg rounded-3" id="subject"
                        placeholder="Enter your subject" value="{{ old('subject') }}" required>
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" class="form-control form-control-lg rounded-3" id="message" rows="5"
                        placeholder="Your message..." required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill">Send Message</button>
            </form>
        </div>
    </div>
</div>

            <!-- Contact Info + Map -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-3 mb-4 p-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Our Office</h4>
                        @if (app(\App\Settings\GeneralSettings::class)->address)
                            <div class="d-flex align-items-center mb-3">
                                <div class="contact-icon bg-danger text-white rounded-circle me-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Address</h6>
                                    <p class="text-muted mb-0">{{ app(\App\Settings\GeneralSettings::class)->address }}</p>
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
                                        {{ app(\App\Settings\GeneralSettings::class)->contact_email }}</p>
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
                                <p class="text-muted mb-0">Mon - Sat: 9:00 AM – 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="ratio ratio-16x9">
                        <!-- Replace with your location -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14739.352372064746!2d85.8314654!3d20.2960587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19a76d4e1cbf07%3A0x1a2fc30deea556dc!2sBhubaneswar%2C%20Odisha!5e0!3m2!1sen!2sin!4v1629200170201!5m2!1sen!2sin"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="text-center mt-5" data-aos="fade-up">
            <h4 class="fw-bold mb-4">Follow Us</h4>
            <div class="social-links">
                @if (app(\App\Settings\GeneralSettings::class)->facebook_url)
                    <a href="{{ app(\App\Settings\GeneralSettings::class)->facebook_url }}"
                        class="social-link bg-danger text-white" target="_blank"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if (app(\App\Settings\GeneralSettings::class)->twitter_url)
                    <a href="{{ app(\App\Settings\GeneralSettings::class)->twitter_url }}"
                        class="social-link bg-danger text-white" target="_blank"><i class="fab fa-twitter"></i></a>
                @endif
                @if (app(\App\Settings\GeneralSettings::class)->linkedin_url)
                    <a href="{{ app(\App\Settings\GeneralSettings::class)->linkedin_url }}"
                        class="social-link bg-danger text-white" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if (app(\App\Settings\GeneralSettings::class)->instagram_url)
                    <a href="{{ app(\App\Settings\GeneralSettings::class)->instagram_url }}"
                        class="social-link bg-danger text-white" target="_blank"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
        </div>
    </div>

    <style>
        .contact-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
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
