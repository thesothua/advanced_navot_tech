<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            SuperAdminSeeder::class,
        ]);

        // Minimal sample data for quotations
        if (\App\Models\Customer::count() === 0) {
            \App\Models\Customer::create([
                'company_name' => 'Acme Corp',
                'authorized_person_name' => 'John Doe',
                'authorized_person_number' => '9999999999',
                'email' => 'john@acme.test',
                'gst_no' => '29ABCDE1234F1Z5',
                'address' => '123 Street, City',
                'country' => 'India',
                'state' => 'Karnataka',
                'city' => 'Bengaluru',
            ]);
        }

        if (\App\Models\Product::count() === 0) {
            \App\Models\Brand::firstOrCreate(['name' => 'Generic']);
            \App\Models\Product::create([
                'name' => 'Sample Product',
                'slug' => 'sample-product',
                'price' => 1000,
                'sale_price' => 900,
                'stock' => 10,
                'sku' => 'SP-001',
                'brand_id' => \App\Models\Brand::first()->id,
                'is_active' => true,
                'is_featured' => false,
                'meta_data' => [],
            ]);
        }
    }
}
