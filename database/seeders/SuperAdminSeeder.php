<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::create([
            'name'              => 'Super Admin',
            'email'             => 'praveensuthar9553@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $superAdmin->assignRole('super-admin');
    }
}
