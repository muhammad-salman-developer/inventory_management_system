<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // ✅ STEP 1: Pehle saari permissions banao
    $permissions = [
        // Products
        'create-product',
        'edit-product',
        'delete-product',
        'view-product',

        // Categories
        'create-category',
        'edit-category',
        'delete-category',
        'view-category',

        // Suppliers
        'create-supplier',
        'edit-supplier',
        'delete-supplier',

        // Customers
        'create-customer',
        'edit-customer',
        'delete-customer',

        // Purchases
        'create-purchase',
        'view-purchase',

        // Sales
        'create-sale',
        'view-sale',
        'view-own-sales',

        // Users
        'create-user',
        'edit-user',
        'delete-user',
        'view-user',

        // Reports
        'view-reports',
    ];

    foreach ($permissions as $permission) {
        Permission::updateOrInsert(['name' => $permission], ['name' => $permission, 'guard_name' => 'web']);
    }

    // ✅ STEP 2: Phir Roles banao
    $admin = Role::updateOrCreate(['name' => 'admin'], ['name' => 'admin']);
    $manager = Role::updateOrCreate(['name' => 'manager'], ['name' => 'manager']);
    $staff = Role::updateOrCreate(['name' => 'staff'], ['name' => 'staff']);

    // ✅ STEP 3: Phir Roles ko Permissions assign karo
    // Admin ko sab permissions
    $admin->givePermissionTo(Permission::all());

    // Manager ko limited permissions
    $manager->givePermissionTo([
        'create-product', 'edit-product',
        'delete-product', 'view-product',
        'create-category', 'edit-category',
        'delete-category', 'view-category',
        'create-supplier', 'edit-supplier',
        'delete-supplier',
        'create-customer', 'edit-customer',
        'delete-customer',
        'create-purchase', 'view-purchase',
        'create-sale', 'view-sale',
        'view-reports',
    ]);

    // Staff ko sirf basic permissions
    $staff->givePermissionTo([
        'view-product',
        'create-customer', 'edit-customer',
        'create-sale', 'view-own-sales',
    ]);
}
}
