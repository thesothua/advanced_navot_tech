@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Brand Details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-danger me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Brand Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $brand->name }}</p>
                        <p><strong>Slug:</strong> {{ $brand->slug }}</p>
                        <p><strong>Status:</strong> 
                            @if($brand->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Website:</strong> 
                            @if($brand->website)
                                <a href="{{ $brand->website }}" target="_blank">{{ $brand->website }}</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                        <p><strong>Created:</strong> {{ $brand->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Updated:</strong> {{ $brand->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                
                @if($brand->description)
                <div class="mt-3">
                    <h6>Description:</h6>
                    <p>{{ $brand->description }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($brand->products->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Products by this Brand</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brand->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-danger">
                        <i class="fas fa-edit"></i> Edit Brand
                    </a>
                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this brand?')">
                            <i class="fas fa-trash"></i> Delete Brand
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 