@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product Details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-danger me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Slug:</strong> {{ $product->slug }}</p>
                        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                        @if($product->sale_price)
                            <p><strong>Sale Price:</strong> ${{ number_format($product->sale_price, 2) }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p><strong>Stock:</strong> {{ $product->stock }}</p>
                        <p><strong>Brand:</strong> {{ $product->brand->name ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> 
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
                
                @if($product->description)
                <div class="mt-3">
                    <h6>Description:</h6>
                    <p>{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-danger">
                        <i class="fas fa-edit"></i> Edit Product
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 