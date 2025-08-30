@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Product</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-danger">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Product Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sale_price" class="form-label">Sale Price</label>
                        <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" 
                               id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock *</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                               id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <select class="form-control @error('categories') is-invalid @enderror" id="categories" name="categories[]">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Existing Images Section -->
            <div class="mb-4">
                <label class="form-label">Current Product Images</label>
                @php
                    $existingImages = $product->getMedia('images');
                @endphp
                
                @if($existingImages->count() > 0)
                    <div class="row" id="existing-images">
                        @foreach($existingImages as $image)
                            <div class="col-md-3 col-sm-4 col-6 mb-3" id="image-{{ $image->id }}">
                                <div class="card">
                                    <div class="position-relative">
                                        <img src="{{ $image->getFullUrl() }}" 
                                             alt="{{ $product->name }}" 
                                             class="card-img-top"
                                             style="height: 150px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 p-2">
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm rounded-circle" 
                                                    onclick="deleteImage({{ $image->id }})"
                                                    title="Delete Image">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-2 text-center">
                                        <small class="text-muted">{{ $image->file_name }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No images uploaded yet.
                    </div>
                @endif
            </div>

            <!-- Upload New Images Section -->
            <div class="mb-3">
                <label for="images" class="form-label">Add New Images</label>
                <input type="file" class="form-control @error('images') is-invalid @enderror" 
                       id="images" name="images[]" accept="image/*" multiple>
                <div class="form-text">You can select multiple images at once. Supported formats: JPG, PNG, GIF</div>
                @error('images')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Image Preview Area -->
                <div id="image-preview" class="row mt-3" style="display: none;">
                    <div class="col-12">
                        <label class="form-label">New Images Preview:</label>
                        <div id="preview-container" class="row"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                   value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Featured
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-save"></i> Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Image preview functionality
document.getElementById('images').addEventListener('change', function(e) {
    const files = e.target.files;
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    
    // Clear previous previews
    previewContainer.innerHTML = '';
    
    if (files.length > 0) {
        imagePreview.style.display = 'block';
        
        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 col-sm-4 col-6 mb-3';
                    
                    col.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" 
                                 alt="Preview" 
                                 class="card-img-top"
                                 style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted">${file.name}</small>
                            </div>
                        </div>
                    `;
                    
                    previewContainer.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        imagePreview.style.display = 'none';
    }
});

// Delete image functionality
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/products/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the image from DOM
                const imageElement = document.getElementById(`image-${imageId}`);
                if (imageElement) {
                    imageElement.remove();
                }
                
                // Show success message
                showAlert('Image deleted successfully!', 'success');
                
                // Check if no images left
                const remainingImages = document.querySelectorAll('#existing-images .col-md-3');
                if (remainingImages.length === 0) {
                    document.getElementById('existing-images').innerHTML = `
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No images uploaded yet.
                        </div>
                    `;
                }
            } else {
                showAlert('Error deleting image: ' + (data.message || 'Unknown error'), 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error deleting image. Please try again.', 'danger');
        });
    }
}

// Show alert function
function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Insert at the top of the card body
    const cardBody = document.querySelector('.card-body');
    cardBody.insertBefore(alertDiv, cardBody.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}
</script>
@endpush 