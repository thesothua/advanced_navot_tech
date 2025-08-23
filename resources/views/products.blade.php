@extends('welcome')

@section('title', 'Products')

@section('content')
    <h2>Our Products</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product 1">
                <div class="card-body">
                    <h5 class="card-title">Product One</h5>
                    <p class="card-text">High-quality item at a great price.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product 2">
                <div class="card-body">
                    <h5 class="card-title">Product Two</h5>
                    <p class="card-text">Reliable and durable product for daily use.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
