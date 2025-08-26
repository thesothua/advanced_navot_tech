@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Access Control Dashboard</h1>
</div>

<div class="row">
    <!-- Roles Overview -->
    <div class="col-md-3 mb-4">
        <div class="card stats-card primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Roles</h6>
                        <h3 class="mb-0">{{ $roles->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-tag fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissions Overview -->
    <div class="col-md-3 mb-4">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Permissions</h6>
                        <h3 class="mb-0">{{ $permissions->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-key fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Overview -->
    <div class="col-md-3 mb-4">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Users</h6>
                        <h3 class="mb-0">{{ $totalUsers }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Sessions -->
    <div class="col-md-3 mb-4">
        <div class="card stats-card danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Active Sessions</h6>
                        <h3 class="mb-0">{{ $roles->sum('users_count') }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-shield-alt fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.access-control.roles') }}" class="btn btn-danger w-100">
                            <i class="fas fa-user-tag me-2"></i>
                            Manage Roles & Permissions
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger w-100">
                            <i class="fas fa-users me-2"></i>
                            Manage Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Roles Summary -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Roles Summary</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Users Count</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td>
                                    <span class="badge bg-danger">{{ ucfirst($role->name) }}</span>
                                </td>
                                <td>{{ $role->users_count }}</td>
                                <td>{{ $role->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.access-control.roles') }}#role-{{ $role->id }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No roles found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection