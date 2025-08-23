@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Permissions</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
        <i class="fas fa-plus me-2"></i>Create New Permission
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Permissions Overview -->
<div class="row mb-4">
    <div class="col-md-4">
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
    <div class="col-md-4">
        <div class="card stats-card primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Permission Groups</h6>
                        <h3 class="mb-0">{{ $grouped_permissions->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-layer-group fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Assigned to Roles</h6>
                        <h3 class="mb-0">{{ $permissions->sum('roles_count') }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-tag fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grouped Permissions -->
@foreach($grouped_permissions as $group => $groupPermissions)
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-folder me-2"></i>{{ ucfirst($group) }} Permissions
                    <span class="badge bg-secondary ms-2">{{ $groupPermissions->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                <th>Guard</th>
                                <th>Roles Count</th>
                                <th>Users Count</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupPermissions as $permission)
                            <tr>
                                <td>
                                    <span class="badge bg-info">{{ $permission->name }}</span>
                                </td>
                                <td>{{ $permission->guard_name }}</td>
                                <td>{{ $permission->roles_count }}</td>
                                <td>{{ $permission->users_count }}</td>
                                <td>{{ $permission->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="editPermission({{ $permission->id }}, '{{ $permission->name }}', '{{ $permission->guard_name }}')"
                                            data-bs-toggle="modal" data-bs-target="#editPermissionModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    @if($permission->roles_count == 0 && $permission->users_count == 0)
                                    <form action="{{ route('admin.access-control.permissions.destroy', $permission) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this permission?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@if($grouped_permissions->count() == 0)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-key fa-3x text-muted mb-3"></i>
                <h5>No Permissions Found</h5>
                <p class="text-muted">Create your first permission to get started.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
                    <i class="fas fa-plus me-2"></i>Create Permission
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Create Permission Modal -->
<div class="modal fade" id="createPermissionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.access-control.permissions.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               placeholder="e.g., users-create, products-edit, orders-view">
                        <small class="form-text text-muted">
                            Use kebab-case format with group prefix (e.g., users-create, products-edit)
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="guard_name" class="form-label">Guard Name</label>
                        <select class="form-control" id="guard_name" name="guard_name" required>
                            <option value="web">Web</option>
                            <option value="api">API</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Permission Modal -->
<div class="modal fade" id="editPermissionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPermissionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                        <small class="form-text text-muted">
                            Use kebab-case format with group prefix (e.g., users-create, products-edit)
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Update Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPermission(id, name, guardName) {
    document.getElementById('edit_name').value = name;
    document.getElementById('editPermissionForm').action = `/admin/access-control/permissions/${id}`;
}
</script>
@endsection