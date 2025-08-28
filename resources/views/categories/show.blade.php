@extends('welcome')

@section('title', $category->name)

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>{{ $category->name }}</h2>
                @if($category->description)
                    <p class="lead">{{ $category->description }}</p>
                @endif
            </div>
        </div>

        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @php
                                $media = $product->getFirstMedia('images');
                            @endphp
                            @if($media)
                                <img src="{{ $media->getUrl() }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <!-- <p class="card-text text-danger fw-bold">₹{{ number_format($product->price, 2) }}</p> -->
                                @if($product->sale_price)
                                    <p class="card-text"><span class="text-decoration-line-through">₹{{ number_format($product->price, 2) }}</span> <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span></p>
                                @endif
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="#" class="btn btn-sm btn-outline-danger">View Details</a>
                                <!-- <button class="btn btn-sm btn-danger">Add to Cart</button> -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ $products->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info">
                No products found in this category.
            </div>
        @endif
    </div>
@endsection