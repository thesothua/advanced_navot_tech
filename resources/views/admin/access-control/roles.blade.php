@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Roles</h1>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        <i class="fas fa-plus me-2"></i>Create New Role
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Roles List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Guard</th>
                                <th>Users Count</th>
                                <th>Permissions Count</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr id="role-{{ $role->id }}">
                                <td>
                                    <span class="badge bg-danger">{{ ucfirst($role->name) }}</span>
                                </td>
                                <td>{{ $role->guard_name }}</td>
                                <td>{{ $role->users_count }}</td>
                                <td>{{ $role->permissions_count }}</td>
                                <td>{{ $role->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="editRole({{ $role->id }}, '{{ $role->name }}', '{{ $role->guard_name }}')"
                                            data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                            onclick="managePermissions({{ $role->id }}, '{{ $role->name }}')"
                                            data-bs-toggle="modal" data-bs-target="#permissionsModal">
                                        <i class="fas fa-key"></i> Permissions
                                    </button>
                                    @if($role->users_count == 0)
                                    <form action="{{ route('admin.access-control.roles.destroy', $role) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No roles found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Role Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.access-control.roles.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <small class="form-text text-muted">
                            Use lowercase with hyphens (e.g., content-manager, product-editor)
                        </small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions as $permission)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           value="{{ $permission->id }}" 
                                           id="perm_{{ $permission->id }}" 
                                           name="permissions[]">
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Manage Permissions Modal -->
<div class="modal fade" id="permissionsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="permissionsForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Manage Permissions for <span id="role-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="permissions-list">
                        @foreach($permissions as $permission)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input permission-check" type="checkbox" 
                                       value="{{ $permission->id }}" 
                                       id="edit_perm_{{ $permission->id }}" 
                                       name="permissions[]">
                                <label class="form-check-label" for="edit_perm_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Update Permissions</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editRole(id, name, guardName) {
    document.getElementById('edit_name').value = name;
    document.getElementById('editRoleForm').action = `/admin/access-control/roles/${id}`;
}

function managePermissions(roleId, roleName) {
    document.getElementById('role-name').textContent = roleName;
    document.getElementById('permissionsForm').action = `/admin/access-control/roles/${roleId}`;
    
    // Clear all checkboxes first
    document.querySelectorAll('.permission-check').forEach(cb => cb.checked = false);
    
         // Fetch role permissions and check appropriate boxes
     fetch(`/admin/access-control/roles/${roleId}/permissions`, {
         headers: {
             'Accept': 'application/json',
             'X-Requested-With': 'XMLHttpRequest'
         }
     })
         .then(response => response.json())
        .then(data => {
            data.permissions.forEach(permissionId => {
                const checkbox = document.getElementById(`edit_perm_${permissionId}`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        })
        .catch(error => console.error('Error:', error));
}
</script>
@endsection