@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Customer</h1>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name *</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name"
                        name="customer_name" value="{{ old('customer_name') }}" required>
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name"
                        name="company_name" value="{{ old('company_name') }}">
                    @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gst_no" class="form-label">GST No.</label>
                    <input type="text" class="form-control @error('gst_no') is-invalid @enderror" id="gst_no"
                        name="gst_no" value="{{ old('gst_no') }}">
                    @error('gst_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_source" class="form-label">Contact Source</label>
                    <input type="text" class="form-control @error('contact_source') is-invalid @enderror" id="contact_source"
                        name="contact_source" value="{{ old('contact_source') }}">
                    @error('contact_source')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="address_street" class="form-label">Street</label>
                                    <input type="text" class="form-control" id="address_street" name="address[street]" value="{{ old('address.street') }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="address_city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="address_city" name="address[city]" value="{{ old('address.city') }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="address_state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="address_state" name="address[state]" value="{{ old('address.state') }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="address_zip" class="form-label">Zip/Postal Code</label>
                                    <input type="text" class="form-control" id="address_zip" name="address[zip]" value="{{ old('address.zip') }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="address_country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="address_country" name="address[country]" value="{{ old('address.country') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('address')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="ACTIVE" {{ old('status', 'ACTIVE') == 'ACTIVE' ? 'selected' : '' }}>
                            ACTIVE</option>
                        <option value="INACTIVE" {{ old('status', 'ACTIVE') == 'INACTIVE' ? 'selected' : '' }}>
                            INACTIVE</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="text-end">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save"></i> Create Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
