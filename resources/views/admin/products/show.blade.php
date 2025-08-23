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
    <!-- Product Images Gallery -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Images</h5>
            </div>
            <div class="card-body">
                @php
                    $images = $product->getMedia('images');
                @endphp
                
                @if($images->count() > 0)
                    <div class="row">
                        @foreach($images as $image)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="image-container" style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);">
                                    <img src="{{ $image->getFullUrl() }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-fluid product-image"
                                         style="width: 100%; height: 200px; object-fit: cover; cursor: pointer; transition: transform 0.3s ease;"
                                         onclick="showImageModal('{{ $image->getFullUrl() }}', '{{ $product->name }}')">
                                    <div class="image-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(220, 53, 69, 0.8); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-search-plus text-white" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-image text-muted" style="font-size: 48px;"></i>
                        <p class="text-muted mt-2">No images available for this product</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

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
                        <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
                        @if($product->sale_price)
                            <p><strong>Sale Price:</strong> ₹{{ number_format($product->sale_price, 2) }}</p>
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
                        <p><strong>Categories:</strong> 
                            @if($product->categories->count() > 0)
                                @foreach($product->categories as $category)
                                    <span class="badge bg-danger me-1">{{ $category->name }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">No categories</span>
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

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    .product-image:hover {
        transform: scale(1.05);
    }
    
    /* .image-container:hover .image-overlay {
        opacity: 1 !important;
    } */
    
    .image-container {
        transition: transform 0.3s ease;
    }
    
    .image-container:hover {
        transform: translateY(-2px);
    }
</style>

<script>
function showImageModal(imageUrl, productName) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('modalImage').alt = productName;
    document.getElementById('imageModalLabel').textContent = productName + ' - Image';
    
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}
</script>
@endpush 