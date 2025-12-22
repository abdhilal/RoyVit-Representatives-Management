<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web',
            'description' => 'Super Admin Role with all permissions',
        ]);
        $superAdminRole->givePermissionTo(Permission::all());


        $representativeRole = Role::create([
            'name' => 'representative',
            'guard_name' => 'web',
            'description' => 'Representative Role with limited permissions',
        ]);
        $representativeRole->givePermissionTo([


            'create-areas',
            'view-classifications',
            'show-classifications',
            'create-classifications',
            'update-classifications',
            'delete-classifications',


            'view-doctors',
            'show-doctors',
            'create-doctors',
            'update-doctors',
            'delete-doctors',

            'view-specializations',
            'show-specializations',
            'create-specializations',
            'update-specializations',
            'delete-specializations',


            'show-invoices',

            'view-invoice_items',
            'show-invoice_items',

            'view-orders',
            'show-orders',
            'create-orders',
            'update-orders',
            'delete-orders',

            'view-doctor_visits',
            'show-doctor_visits',
            'create-doctor_visits',


            'view-visit_samples',
            'show-visit_samples',
            'create-visit_samples',




            'show-representative_stores',
            'view-invoices',





        ]);
    }
}
