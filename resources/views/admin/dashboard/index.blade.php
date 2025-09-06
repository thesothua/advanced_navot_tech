@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-primary mb-1 small">Total Users</h6>
                            <h2 class="mb-0 fw-bold">{{ $stats['total_users'] }}</h2>
                        </div>
                        <div class="icon-circle bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-users fa-lg text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-success">
                        <i class="fas fa-arrow-up me-1"></i> 12% increase this month
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-success mb-1 small">Total Products</h6>
                            <h2 class="mb-0 fw-bold">{{ $stats['total_products'] }}</h2>
                        </div>
                        <div class="icon-circle bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-box fa-lg text-success"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-success">
                        <i class="fas fa-arrow-up me-1"></i> 8% increase this month
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-warning mb-1 small">Active Products</h6>
                            <h2 class="mb-0 fw-bold">{{ $stats['active_products'] }}</h2>
                        </div>
                        <div class="icon-circle bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-check-circle fa-lg text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-success">
                        <i class="fas fa-arrow-up me-1"></i> 5% increase this month
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-semibold text-danger mb-1 small">Featured Products</h6>
                            <h2 class="mb-0 fw-bold">{{ $stats['featured_products'] }}</h2>
                        </div>
                        <div class="icon-circle bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-star fa-lg text-danger"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-success">
                        <i class="fas fa-arrow-up me-1"></i> 3% increase this month
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="row">




        @if (canSuperAdminOr('view-products'))

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold">Recent Products</h5>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        @if ($recent_products->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($recent_products as $product)
                                    <div class="list-group-item border-start-0 border-end-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-square bg-light text-primary me-3 p-2 rounded">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-semibold">{{ $product->name }}</h6>
                                                    <div class="d-flex align-items-center small">
                                                        <span
                                                            class="badge bg-light text-secondary me-2">{{ $product->brand->name ?? 'N/A' }}</span>
                                                        <span class="text-muted"><i class="fas fa-clock me-1"></i>
                                                            {{ $product->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <span
                                                class="badge bg-primary rounded-pill">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-box fa-3x text-light mb-3"></i>
                                <p class="text-muted">No products found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        @endif


        @if (canSuperAdminOr('view-users'))

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold">Recent Users</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        @if ($recent_users->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($recent_users as $user)
                                    <div class="list-group-item border-start-0 border-end-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-square bg-light text-primary me-3 p-2 rounded-circle">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                                                    <div class="d-flex align-items-center small">
                                                        <span class="text-muted">{{ $user->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <span
                                                    class="badge bg-light text-dark">{{ $user->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-light mb-3"></i>
                                <p class="text-muted">No users found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
