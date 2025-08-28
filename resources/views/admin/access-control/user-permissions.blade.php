@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User Permissions Management</h1>
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

<!-- Users Overview -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card stats-card primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Users</h6>
                        <h3 class="mb-0">{{ $users->total() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Available Roles</h6>
                        <h3 class="mb-0">{{ $roles->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-tag fa-2x text-success"></i>
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
                        <h6 class="card-title text-muted">Available Permissions</h6>
                        <h3 class="mb-0">{{ $permissions->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-key fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Users List -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Users & Their Permissions</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Direct Permissions</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                            <span class="text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse($user->roles as $role)
                                        <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                    @empty
                                        <span class="text-muted">No roles</span>
                                    @endforelse
                                </td>
                                <td>
                                    @php
                                        $directPermissions = $user->getDirectPermissions();
                                    @endphp
                                    @forelse($directPermissions as $permission)
                                        <span class="badge bg-info me-1">{{ $permission->name }}</span>
                                    @empty
                                        <span class="text-muted">No direct permissions</span>
                                    @endforelse
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="manageUserRoles({{ $user->id }}, '{{ $user->name }}')"
                                            data-bs-toggle="modal" data-bs-target="#userRolesModal">
                                        <i class="fas fa-user-tag"></i> Roles
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                            onclick="manageUserPermissions({{ $user->id }}, '{{ $user->name }}')"
                                            data-bs-toggle="modal" data-bs-target="#userPermissionsModal">
                                        <i class="fas fa-key"></i> Permissions
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No users found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Roles Modal -->
<div class="modal fade" id="userRolesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="userRolesForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Manage Roles for <span id="user-name-roles"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach($roles as $role)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input user-role-check" type="checkbox" 
                                       value="{{ $role->id }}" 
                                       id="user_role_{{ $role->id }}" 
                                       name="roles[]">
                                <label class="form-check-label" for="user_role_{{ $role->id }}">
                                    {{ $role->name }}
                                    <small class="text-muted d-block">{{ $role->permissions->count() }} permissions</small>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Update Roles</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Permissions Modal -->
<div class="modal fade" id="userPermissionsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Direct Permissions for <span id="user-name-permissions"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    These are direct permissions assigned to the user, separate from role-based permissions.
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Available Permissions</h6>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            <div id="available-permissions">
                                @foreach($permissions as $permission)
                                <div class="permission-item mb-2 p-2 border rounded">
                                    <span class="badge bg-secondary">{{ $permission->name }}</span>
                                    <button type="button" class="btn btn-xs btn-outline-success ms-2" 
                                            onclick="assignPermission({{ $permission->id }}, '{{ $permission->name }}')">
                                        <i class="fas fa-plus"></i> Assign
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>User's Direct Permissions</h6>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            <div id="user-permissions-list">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.8rem;
}
.permission-item {
    background-color: #f8f9fa;
}
</style>

<script>
let currentUserId = null;

function manageUserRoles(userId, userName) {
    currentUserId = userId;
    document.getElementById('user-name-roles').textContent = userName;
    document.getElementById('userRolesForm').action = `/admin/access-control/users/${userId}/sync-roles`;
    
    // Clear all checkboxes first
    document.querySelectorAll('.user-role-check').forEach(cb => cb.checked = false);
    
         // Fetch user roles and check appropriate boxes
     fetch(`/admin/access-control/users/${userId}/roles-permissions`, {
         headers: {
             'Accept': 'application/json',
             'X-Requested-With': 'XMLHttpRequest'
         }
     })
         .then(response => response.json())
         .then(data => {
             data.roles.forEach(roleId => {
                const checkbox = document.getElementById(`user_role_${roleId}`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        })
        .catch(error => console.error('Error:', error));
}

function manageUserPermissions(userId, userName) {
    currentUserId = userId;
    document.getElementById('user-name-permissions').textContent = userName;
    
         // Fetch and display user's direct permissions
     fetch(`/admin/access-control/users/${userId}/roles-permissions`, {
         headers: {
             'Accept': 'application/json',
             'X-Requested-With': 'XMLHttpRequest'
         }
     })
         .then(response => response.json())
        .then(data => {
            const permissionsList = document.getElementById('user-permissions-list');
            permissionsList.innerHTML = '';
            
            if (data.direct_permissions.length === 0) {
                permissionsList.innerHTML = '<p class="text-muted">No direct permissions assigned</p>';
            } else {
                data.direct_permissions.forEach(permissionId => {
                    const permission = @json($permissions).find(p => p.id === permissionId);
                    if (permission) {
                        const permissionDiv = document.createElement('div');
                        permissionDiv.className = 'permission-item mb-2 p-2 border rounded';
                        permissionDiv.innerHTML = `
                            <span class="badge bg-info">${permission.name}</span>
                            <button type="button" class="btn btn-xs btn-outline-danger ms-2" 
                                    onclick="revokePermission(${permission.id}, '${permission.name}')">
                                <i class="fas fa-minus"></i> Revoke
                            </button>
                        `;
                        permissionsList.appendChild(permissionDiv);
                    }
                });
            }
        })
        .catch(error => console.error('Error:', error));
}

function assignPermission(permissionId, permissionName) {
    if (!currentUserId) return;
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('permission_id', permissionId);
    
                   fetch(`/admin/access-control/users/${currentUserId}/permissions`, {
          method: 'POST',
          headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
          },
          body: formData
      })
      .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Refresh the permissions list
            manageUserPermissions(currentUserId, document.getElementById('user-name-permissions').textContent);
        }
    })
    .catch(error => console.error('Error:', error));
}

function revokePermission(permissionId, permissionName) {
    if (!currentUserId) return;
    
    if (!confirm(`Are you sure you want to revoke the "${permissionName}" permission?`)) {
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    formData.append('permission_id', permissionId);
    
                   fetch(`/admin/access-control/users/${currentUserId}/permissions`, {
          method: 'DELETE',
          headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
          },
          body: formData
      })
      .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Refresh the permissions list
            manageUserPermissions(currentUserId, document.getElementById('user-name-permissions').textContent);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection