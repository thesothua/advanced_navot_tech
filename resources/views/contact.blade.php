@extends('welcome')

@section('title', 'Contact Us')

@section('content')
    <div class="container py-5 mt-5">
        <h2 class="text-center mb-4 text-danger fw-bold">Contact Us</h2>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Your message..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger px-4">Send Message</button>
                </form>
            </div>

            <!-- Contact Info + Map -->
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="mb-4">
                    <h5 class="text-danger fw-bold">Our Office</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Bhubaneswar, Odisha, India</p>
                    <p><i class="fas fa-envelope me-2"></i> support@firesafety.com</p>
                    <p><i class="fas fa-phone me-2"></i> +91 98765 43210</p>
                    <p><i class="fas fa-clock me-2"></i> Mon - Sat: 9:00 AM – 6:00 PM</p>
                </div>

                <div class="ratio ratio-16x9">
                    <!-- Replace with your location -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14739.352372064746!2d85.8314654!3d20.2960587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19a76d4e1cbf07%3A0x1a2fc30deea556dc!2sBhubaneswar%2C%20Odisha!5e0!3m2!1sen!2sin!4v1629200170201!5m2!1sen!2sin"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="text-center mt-5">
            <h5 class="text-danger fw-bold">Follow Us</h5>
            <a href="#" class="btn btn-outline-light btn-floating m-1 bg-danger"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-outline-light btn-floating m-1 bg-danger"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-outline-light btn-floating m-1 bg-danger"><i
                    class="fab fa-linkedin-in"></i></a>
            <a href="#" class="btn btn-outline-light btn-floating m-1 bg-danger"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
@endsection
