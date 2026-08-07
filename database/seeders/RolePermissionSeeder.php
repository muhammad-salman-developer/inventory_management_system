<?php

namespace Database\Seeders;

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
        //  STEP 1: firstly all permissions create
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
            'view-supplier',

            // Customers
            'view-customer',
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
            
            // stocks
            'view-stocks',
            'adjust-stock',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrInsert(['name' => $permission], ['name' => $permission, 'guard_name' => 'web']);
        }

        //  STEP 2: create Roles 
        $admin = Role::updateOrCreate(['name' => 'admin'], ['name' => 'admin']);
        $manager = Role::updateOrCreate(['name' => 'manager'], ['name' => 'manager']);
        $staff = Role::updateOrCreate(['name' => 'staff'], ['name' => 'staff']);

        //  STEP 3: then apply Roles to assign Permissions 
        // Admin  permissions
        $admin->givePermissionTo(Permission::all());

        // Manager permissions
        $manager->givePermissionTo([
            'create-product', 'edit-product',
            'delete-product', 'view-product',
            'create-category', 'edit-category',
            'delete-category', 'view-category',
            'create-supplier', 'edit-supplier',
            'delete-supplier', 'view-supplier',
            'create-customer', 'edit-customer',
            'delete-customer', 'view-customer',
            'create-purchase', 'view-purchase',
            'create-sale', 'view-sale',
            'view-reports','view-stocks',
            'adjust-stock',
        ]);

        // Staff permissions 
        $staff->givePermissionTo([
            'view-product',
            'create-customer', 'edit-customer',
            'create-sale', 'view-own-sales',
            'view-stocks',
            'adjust-stock',
        ]);
    }
}
