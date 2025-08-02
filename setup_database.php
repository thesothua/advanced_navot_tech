<?php

// Simple database setup script
// Run this to check if database connection works

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    // Test database connection
    DB::connection()->getPdo();
    echo "✅ Database connection successful!\n";
    
    // Check if tables exist
    $tables = ['users', 'products', 'categories', 'brands'];
    
    foreach ($tables as $table) {
        if (Schema::hasTable($table)) {
            echo "✅ Table '$table' exists\n";
        } else {
            echo "❌ Table '$table' does not exist\n";
        }
    }
    
    // Check if roles and permissions tables exist
    $permissionTables = ['roles', 'permissions', 'role_has_permissions', 'model_has_roles', 'model_has_permissions'];
    
    foreach ($permissionTables as $table) {
        if (Schema::hasTable($table)) {
            echo "✅ Permission table '$table' exists\n";
        } else {
            echo "❌ Permission table '$table' does not exist\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
} 