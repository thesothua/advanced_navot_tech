<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Users
            'view-users',
            'create-users',
            'update-users',
            'delete-users',

            // Products
            'view-products',
            'create-products',
            'update-products',
            'delete-products',

            // Categories
            'view-categories',
            'create-categories',
            'update-categories',
            'delete-categories',

            // Brands
            'view-brands',
            'create-brands',
            'update-brands',
            'delete-brands',

            // Settings
            'view-settings',
            'update-settings',

            // Notifications
            'view-inquiries',
            'read-inquiries',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin      = Role::create(['name' => 'admin']);
        $manager    = Role::create(['name' => 'manager']);
        $editor     = Role::create(['name' => 'editor']);
        $viewer     = Role::create(['name' => 'viewer']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            // Users
            'view-users',
            'create-users',
            'update-users',
            'delete-users',

            // Products
            'view-products',
            'create-products',
            'update-products',
            'delete-products',

            // Categories
            'view-categories',
            'create-categories',
            'update-categories',
            'delete-categories',

            // Brands
            'view-brands',
            'create-brands',
            'update-brands',
            'delete-brands',

            // Settings
            'view-settings',
            'update-settings',
        ]);

        $manager->givePermissionTo([
            'view-users',
            'view-products',
        ]);

        $editor->givePermissionTo([
            'view-products',

        ]);

        $viewer->givePermissionTo([
            'view-products',
        ]);
    }
}
