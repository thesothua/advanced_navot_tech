<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class AccessControlController extends Controller
{
    /**
     * Display the access control dashboard
     */
    public function index()
    {
        $roles = Role::withCount('users')->get();
        $permissions = Permission::all();
        $totalUsers = User::count();

        return view('admin.access-control.index', compact('roles', 'permissions', 'totalUsers'));
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
     * Create a new role with permissions
     */
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'  // Fixed guard using web model
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return back()->with('success', 'Role created successfully.');
    }

    /**
     * Update an existing role with permissions
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
     * Get role permissions for AJAX requests
     */
    public function getRolePermissions(Role $role)
    {
        return response()->json([
            'permissions' => $role->permissions->pluck('id')
        ]);
    }
}

 