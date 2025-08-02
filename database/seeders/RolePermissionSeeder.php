<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'manage-users',
            'manage-products',
            'manage-categories',
            'manage-brands',
            'manage-settings',
            'view-dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $editor = Role::create(['name' => 'editor']);
        $viewer = Role::create(['name' => 'viewer']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        
        $admin->givePermissionTo([
            'manage-products',
            'manage-categories',
            'manage-brands',
            'view-dashboard',
        ]);
        
        $manager->givePermissionTo([
            'manage-products',
            'manage-categories',
            'view-dashboard',
        ]);
        
        $editor->givePermissionTo([
            'manage-products',
            'view-dashboard',
        ]);
        
        $viewer->givePermissionTo([
            'view-dashboard',
        ]);
    }
} 