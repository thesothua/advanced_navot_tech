@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Customer Details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-danger me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $customer->customer_name }}</p>
                        <p><strong>Company:</strong> {{ $customer->company_name ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
                        <p><strong>GST No:</strong> {{ $customer->gst_no ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> 
                            @if($customer->status == 'ACTIVE')
                                <span class="badge bg-success">ACTIVE</span>
                            @else
                                <span class="badge bg-secondary">INACTIVE</span>
                            @endif
                        </p>
                        <p><strong>Contact Source:</strong> {{ $customer->contact_source ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Description:</strong> {{ $customer->description ?? 'N/A' }}</p>
                        <p><strong>Created:</strong> {{ $customer->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Updated:</strong> {{ $customer->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="border-bottom pb-2">Address Information</h6>
                    </div>
               
                    <div class="col-md-6">
                        <p><strong>Street:</strong> {{ $customer->address['street'] ?? 'N/A' }}</p>
                        <p><strong>City:</strong> {{ $customer->address['city'] ?? 'N/A' }}</p>
                        <p><strong>State:</strong> {{ $customer->address['state'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Zip Code:</strong> {{ $customer->address['zip'] ?? 'N/A' }}</p>
                        <p><strong>Country:</strong> {{ $customer->address['country'] ?? 'N/A' }}</p>
                    </div>
                </div>
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
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-danger">
                        <i class="fas fa-edit"></i> Edit Customer
                    </a>
                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">
                            <i class="fas fa-trash"></i> Delete Customer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection