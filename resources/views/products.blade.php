@extends('welcome')

@section('title', 'Products')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-lg-6 text-center">
                <h6 class="text-danger fw-bold text-uppercase">Our Collection</h6>
                <h2 class="fw-bold display-5 mb-3">Fire Safety Products</h2>
                <p class="lead text-muted">Browse our collection of high-quality fire safety equipment and solutions</p>
            </div>
        </div>

        @if(isset($products) && $products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card h-100 border-0 shadow-sm rounded-3 product-card">
                            @php
                                $media = $product->getFirstMedia('images');
                            @endphp
                            <div class="card-img-container">
                                @if($media)
                                    <img src="{{ $media->getUrl() }}" class="card-img-top rounded-top" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/600x400?text={{ urlencode($product->name) }}" class="card-img-top rounded-top" alt="{{ $product->name }}">
                                @endif
                                @if($product->sale_price)
                                    <div class="sale-badge">SALE</div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                @if($product->brand)
                                    <p class="text-muted small mb-1">{{ $product->brand->name }}</p>
                                @endif
                                <h4 class="card-title fw-bold mb-2">{{ $product->name }}</h4>
                                <div class="mb-3">
                                    @if($product->sale_price)
                                        <span class="text-decoration-line-through text-muted me-2">₹{{ number_format($product->price, 2) }}</span>
                                        <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                    @else
                                        <span class="text-danger fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0 p-4">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-danger">View Details</a>
                                    <button class="btn btn-danger"><i class="fas fa-shopping-cart me-2"></i>Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-5">
                <div class="col-md-12 d-flex justify-content-center" data-aos="fade-up">
                    {{ $products->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info shadow-sm rounded-3 p-4 text-center" data-aos="fade-up">
                <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                <h4>No Products Available</h4>
                <p class="mb-0">We're currently updating our product catalog. Please check back soon!</p>
            </div>
        @endif
    </div>

    <style>
        .product-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
        }
        
        .card-img-container {
            position: relative;
            height: 250px;
            overflow: hidden;
        }
        
        .card-img-top {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .sale-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--bs-danger);
            color: white;
            padding: 5px 10px;
            font-size: 0.8rem;
            font-weight: bold;
            border-radius: 3px;
        }
    </style>
@endsection
