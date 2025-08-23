@extends('welcome')

@section('title', 'About Us')

@section('content')
    <div class="container py-5 mt-5">
        <h2 class="text-center mb-4 text-danger fw-bold">About Us</h2>

        <!-- Company Introduction -->
        <div class="row mb-5">
            <div class="col-md-6">
                <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
                <p>
                    <strong>U29100OR2020PTC033405</strong> is an ISO 9001:2015 certified company based in Bhubaneswar,
                    Odisha.
                    We specialize in sales, service, installation, and maintenance of ISI marked fire extinguishers, hydrant
                    systems,
                    smoke detectors, fire alarms, and a wide range of safety and personal protective equipment.
                </p>
                <p>
                    Our clientele spans government, public, and private sector industries, hospitals, institutions, and
                    housing societies.
                    We pride ourselves on delivering only the highest quality products and services to ensure the safety of
                    lives and assets.
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="row text-center mb-5">
            <div class="col-md-6 mb-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <h4 class="text-danger fw-bold">Our Mission</h4>
                    <p>To provide innovative, reliable, and affordable fire safety solutions while maintaining top-tier
                        customer service and technical excellence.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 border rounded shadow-sm h-100">
                    <h4 class="text-danger fw-bold">Our Vision</h4>
                    <p>To be the most trusted and respected fire safety and equipment provider across India, contributing to
                        a safer tomorrow.</p>
                </div>
            </div>
        </div>

        <!-- Services Highlight -->
        <div class="row text-center mb-5">
            <h4 class="text-center fw-bold text-danger mb-4">Our Core Services</h4>
            <div class="col-md-3">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-fire-extinguisher fa-2x text-danger mb-2"></i>
                    <h6>Fire Extinguishers</h6>
                    <p>Sales, Service & Maintenance of ISI marked extinguishers.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-bell fa-2x text-danger mb-2"></i>
                    <h6>Alarm Systems</h6>
                    <p>Installation of fire alarms, smoke detectors, and hydrant systems.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-shield-alt fa-2x text-danger mb-2"></i>
                    <h6>Safety Gear</h6>
                    <p>Supply of helmets, gloves, shoes, face shields, and more.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-tools fa-2x text-danger mb-2"></i>
                    <h6>Custom Solutions</h6>
                    <p>Customized fire safety plans and equipment based on client needs.</p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="row text-center">
            <h4 class="text-center fw-bold text-danger mb-4">Why Choose Us?</h4>
            <div class="col-md-4">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-certificate fa-2x text-danger mb-2"></i>
                    <h6>ISO Certified</h6>
                    <p>We follow ISO 9001:2015 standards ensuring consistent quality.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-users fa-2x text-danger mb-2"></i>
                    <h6>Client-Centric</h6>
                    <p>Our priority is long-term relationships through satisfaction and trust.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-award fa-2x text-danger mb-2"></i>
                    <h6>Proven Track Record</h6>
                    <p>Trusted by hospitals, industries, housing societies, and more.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
