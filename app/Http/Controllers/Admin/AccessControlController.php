<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccessControlController extends Controller
{
    /**
     * Display the access control dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'users_with_roles' => User::whereHas('roles')->count(),
        ];

        $recent_role_assignments = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->select('users.name as user_name', 'roles.name as role_name', 'model_has_roles.created_at')
            ->orderBy('model_has_roles.created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.access-control.index', compact('stats', 'recent_role_assignments'));
    }

    /**
     * Display roles management page
     */
    public function roles()
    {
        $roles = Role::withCount('users', 'permissions')->get();
        $permissions = Permission::all();
        
        return view('admin.access-control.roles', compact('roles', 'permissions'));
    }

    /**
     * Display permissions management page
     */
    public function permissions()
    {
        $permissions = Permission::withCount('roles', 'users')->get();
        $grouped_permissions = $permissions->groupBy(function ($permission) {
            return explode('-', $permission->name)[0] ?? 'general';
        });

        return view('admin.access-control.permissions', compact('permissions', 'grouped_permissions'));
    }

    /**
     * Display user permissions management page
     */
    public function userPermissions()
    {
        $users = User::with(['roles', 'permissions'])->paginate(15);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.access-control.user-permissions', compact('users', 'roles', 'permissions'));
    }

    /**
     * Create a new role
     */
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return back()->with('success', 'Role created successfully.');
    }

    /**
     * Update an existing role
     */
    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Role updated successfully.');
    }

    /**
     * Delete a role
     */
    public function destroyRole(Role $role)
    {
        // Check if role is assigned to any users
        if ($role->users()->count() > 0) {
            return back()->with('error', 'Cannot delete role that is assigned to users.');
        }

        $role->delete();

        return back()->with('success', 'Role deleted successfully.');
    }

    /**
     * Create a new permission
     */
    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'guard_name' => 'required|string|max:255',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        return back()->with('success', 'Permission created successfully.');
    }

    /**
     * Update an existing permission
     */
    public function updatePermission(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return back()->with('success', 'Permission updated successfully.');
    }

    /**
     * Delete a permission
     */
    public function destroyPermission(Permission $permission)
    {
        // Check if permission is assigned to any roles or users
        if ($permission->roles()->count() > 0 || $permission->users()->count() > 0) {
            return back()->with('error', 'Cannot delete permission that is assigned to roles or users.');
        }

        $permission->delete();

        return back()->with('success', 'Permission deleted successfully.');
    }

    /**
     * Assign role to user
     */
    public function assignUserRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $role = Role::findById($request->role_id);
        $user->assignRole($role);

        return back()->with('success', 'Role assigned to user successfully.');
    }

    /**
     * Remove role from user
     */
    public function removeUserRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $role = Role::findById($request->role_id);
        $user->removeRole($role);

        return back()->with('success', 'Role removed from user successfully.');
    }

    /**
     * Assign permission directly to user
     */
    public function assignUserPermission(Request $request, User $user)
    {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id'
        ]);

        $permission = Permission::findById($request->permission_id);
        $user->givePermissionTo($permission);

        return back()->with('success', 'Permission assigned to user successfully.');
    }

    /**
     * Remove permission from user
     */
    public function revokeUserPermission(Request $request, User $user)
    {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id'
        ]);

        $permission = Permission::findById($request->permission_id);
        $user->revokePermissionTo($permission);

        return back()->with('success', 'Permission revoked from user successfully.');
    }

    /**
     * Sync user roles (replace all current roles)
     */
    public function syncUserRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $roleIds = $request->roles ?? [];
        $roles = Role::whereIn('id', $roleIds)->get();
        
        $user->syncRoles($roles);

        return back()->with('success', 'User roles updated successfully.');
    }

    /**
     * Get role permissions for AJAX requests
     */
    public function getRolePermissions(Role $role)
    {
        return response()->json([
            'permissions' => $role->permissions->pluck('id')
        ]);
    }

    /**
     * Get user roles and permissions for AJAX requests
     */
    public function getUserRolesPermissions(User $user)
    {
        return response()->json([
            'roles' => $user->roles->pluck('id'),
            'direct_permissions' => $user->getDirectPermissions()->pluck('id'),
            'all_permissions' => $user->getAllPermissions()->pluck('id')
        ]);
    }
}