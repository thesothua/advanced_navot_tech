@extends('welcome')

@section('title', $product->name)

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products') }}"
                        class="text-decoration-none text-danger">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Images Carousel -->
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                @if ($images->count() > 0)
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3 shadow-sm">
                            @foreach ($images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $image->getUrl() }}" class="d-block w-100 product-main-image"
                                        alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>

                        @if ($images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>

                    <!-- Thumbnail indicators -->
                    @if ($images->count() > 1)
                        <div class="row g-2 mt-3">
                            @foreach ($images as $index => $image)
                                <div class="col-3">
                                    <img src="{{ $image->getUrl() }}"
                                        class="img-thumbnail thumbnail-indicator {{ $index === 0 ? 'active' : '' }}"
                                        data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}"
                                        alt="{{ $product->name }}"
                                        style="cursor: pointer; height: 80px; width: 100%; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <img src="https://via.placeholder.com/600x400?text={{ urlencode($product->name) }}"
                        class="img-fluid rounded-3 shadow-sm" alt="{{ $product->name }}">
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-lg-6" data-aos="fade-left">
                @if ($product->brand)
                    <p class="text-muted mb-2">{{ $product->brand->name }}</p>
                @endif

                <h1 class="fw-bold mb-3">{{ $product->name }}</h1>

                <!-- Categories -->
                @if ($product->categories->count() > 0)
                    <div class="mb-3">
                        @foreach ($product->categories as $category)
                            <span class="badge bg-light text-dark me-1">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif

                <!-- Price -->
                <div class="mb-4">
                    @if ($product->sale_price > 0)
                        <span
                            class="text-decoration-line-through text-muted me-3 fs-5">₹{{ number_format($product->price, 2) }}</span>
                        <span class="text-danger fw-bold fs-3">₹{{ number_format($product->sale_price, 2) }}</span>
                        <span class="badge bg-danger ms-2">SALE</span>
                    @elseif ($product->price > 0)
                        <span class="text-danger fw-bold fs-3">₹{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <!-- Stock Status -->
                {{-- <div class="mb-4">
                    @if ($product->stock > 0)
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-check-circle me-1"></i>In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="badge bg-danger fs-6">
                            <i class="fas fa-times-circle me-1"></i>Out of Stock
                        </span>
                    @endif
                </div> --}}

                <!-- SKU -->
                @if ($product->sku)
                    <p class="text-muted small mb-3">SKU: {{ $product->sku }}</p>
                @endif

                <!-- Action Buttons -->
                <div class="d-flex gap-3 mb-4">
                    {{-- <button class="btn btn-danger btn-lg flex-fill" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                    </button> --}}
                    {{-- <button class="btn btn-outline-danger btn-lg">
                        <i class="fas fa-heart"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-share-alt"></i>
                    </button> --}}

                     <a href="{{ route('contact') }}" class="btn btn-outline-danger btn-sm">Get Quotation</a>


                    {{-- <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('contact') }}" class="btn btn-outline-danger btn-sm">Get Quotation</a>
                    </div> --}}

                </div>

                <!-- Quick Info -->
                {{-- <div class="border rounded-3 p-3">
                    <div class="row g-2">
                        <div class="col-6">
                            <i class="fas fa-truck text-danger me-2"></i>
                            <small>Free Shipping</small>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-shield-alt text-danger me-2"></i>
                            <small>2 Year Warranty</small>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-undo text-danger me-2"></i>
                            <small>30 Day Returns</small>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-headset text-danger me-2"></i>
                            <small>24/7 Support</small>
                        </div>
                    </div>
                </div> --}}


                <!-- Product Description -->
                <div class="row mt-5">
                    <div class="col-12" data-aos="fade-up">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h3 class="card-title mb-0">Product Description</h3>
                            </div>
                            <div class="card-body">
                                @if ($product->description)
                                    <div class="product-description">
                                        {!! nl2br(e($product->description)) !!}
                                    </div>
                                @else
                                    <p class="text-muted">No description available for this product.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>



        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <div class="row mt-5">
                <div class="col-12" data-aos="fade-up">
                    <h3 class="fw-bold mb-4">Related Products</h3>
                    <div class="row g-4">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 border-0 shadow-sm rounded-3 product-card">
                                    @php
                                        $media = $relatedProduct->getFirstMedia('images');
                                    @endphp
                                    <div class="card-img-container">
                                        @if ($media)
                                            <img src="{{ $media->getUrl() }}" class="card-img-top rounded-top"
                                                alt="{{ $relatedProduct->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/300x200?text={{ urlencode($relatedProduct->name) }}"
                                                class="card-img-top rounded-top" alt="{{ $relatedProduct->name }}">
                                        @endif
                                        @if ($relatedProduct->sale_price > 0)
                                            <div class="sale-badge">SALE</div>
                                        @endif
                                    </div>
                                    <div class="card-body p-3">
                                        @if ($relatedProduct->brand)
                                            <p class="text-muted small mb-1">{{ $relatedProduct->brand->name }}</p>
                                        @endif
                                        <h5 class="card-title fw-bold mb-2">{{ Str::limit($relatedProduct->name, 30) }}
                                        </h5>
                                        <div class="mb-2">
                                            @if ($relatedProduct->sale_price > 0)
                                                <span
                                                    class="text-decoration-line-through text-muted me-2">₹{{ number_format($relatedProduct->price, 2) }}</span>
                                                <span
                                                    class="text-danger fw-bold">₹{{ number_format($relatedProduct->sale_price, 2) }}</span>
                                            @elseif ($relatedProduct->price > 0)
                                                <span
                                                    class="text-danger fw-bold">₹{{ number_format($relatedProduct->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-top-0 p-3">
                                        <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                            class="btn btn-outline-danger btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .product-main-image {
            height: 500px;
            object-fit: cover;
        }

        .thumbnail-indicator {
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .thumbnail-indicator:hover,
        .thumbnail-indicator.active {
            opacity: 1;
            border-color: var(--bs-danger);
        }

        .product-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .card-img-container {
            position: relative;
            height: 200px;
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
            top: 10px;
            right: 10px;
            background-color: var(--bs-danger);
            color: white;
            padding: 3px 8px;
            font-size: 0.7rem;
            font-weight: bold;
            border-radius: 3px;
        }

        .product-description {
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }


        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 20px;
        }
    </style>
@endsection
