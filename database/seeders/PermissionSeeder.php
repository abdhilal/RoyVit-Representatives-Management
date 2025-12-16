<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPermissions = [
            'group_name' => 'users',
            'guard_name' => 'web',
            'permissions' => [
                'view-users',
                'show-users',
                'create-users',
                'update-users',
                'delete-users',
                'restore-users',
                'force-delete-users'
            ]
        ];

        $rolePermissions = [
            'group_name' => 'roles',
            'guard_name' => 'web',
            'permissions' => [
                'view-roles',
                'show-roles',
                'create-roles',
                'update-roles',
                'delete-roles',
            ]
        ];

        $warehousePermissions = [
            'group_name' => 'warehouses',
            'guard_name' => 'web',
            'permissions' => [
                'view-warehouses',
                'show-warehouses',
                'create-warehouses',
                'update-warehouses',
                'delete-warehouses',
            ]
        ];

        $cityPermissions = [
            'group_name' => 'cities',
            'guard_name' => 'web',
            'permissions' => [
                'view-cities',
                'show-cities',
                'create-cities',
                'update-cities',
                'delete-cities',
            ]
        ];
        $areaPermissions = [
            'group_name' => 'areas',
            'guard_name' => 'web',
            'permissions' => [
                'view-areas',
                'show-areas',
                'create-areas',
                'update-areas',
                'delete-areas',
            ]
        ];
        $classificationPermissions = [
            'group_name' => 'classifications',
            'guard_name' => 'web',
            'permissions' => [
                'view-classifications',
                'show-classifications',
                'create-classifications',
                'update-classifications',
                'delete-classifications',
            ]
        ];
        $doctorPermissions = [
            'group_name' => 'doctors',
            'guard_name' => 'web',
            'permissions' => [
                'view-doctors',
                'show-doctors',
                'create-doctors',
                'update-doctors',
                'delete-doctors',
            ]
        ];

        $representativePermissions = [
            'group_name' => 'representatives',
            'guard_name' => 'web',
            'permissions' => [
                'view-representatives',
                'show-representatives',
                'create-representatives',
                'update-representatives',
                'delete-representatives',
            ]
        ];
        $specializationPermissions = [
            'group_name' => 'specializations',
            'guard_name' => 'web',
            'permissions' => [
                'view-specializations',
                'show-specializations',
                'create-specializations',
                'update-specializations',
                'delete-specializations',
            ]
        ];
        $filePermissions = [
            'group_name' => 'files',
            'guard_name' => 'web',
            'permissions' => [
                'view-files',
                'show-files',
                'create-files',
                'update-files',
                'delete-files',
            ]
        ];
        $productPermissions = [
            'group_name' => 'products',
            'guard_name' => 'web',
            'permissions' => [
                'view-products',
                'show-products',
                'create-products',
                'update-products',
                'delete-products',
            ]
        ];
        $representativeStorePermissions = [
            'group_name' => 'representative_stores',
            'guard_name' => 'web',
            'permissions' => [
                'view-representative_stores',
                'show-representative_stores',
                'create-representative_stores',
                'update-representative_stores',
                'delete-representative_stores',
            ]
        ];
        $invoicesPermissions = [
            'group_name' => 'invoices',
            'guard_name' => 'web',
            'permissions' => [
                'view-invoices',
                'show-invoices',
                'create-invoices',
                'update-invoices',
                'delete-invoices',
            ]
        ];
        $invoiceItemsPermissions = [
            'group_name' => 'invoice_items',
            'guard_name' => 'web',
            'permissions' => [
                'view-invoice_items',
                'show-invoice_items',
                'create-invoice_items',
                'update-invoice_items',
                'delete-invoice_items',
            ]
        ];
        $orderPermissions = [
            'group_name' => 'orders',
            'guard_name' => 'web',
            'permissions' => [
                'view-orders',
                'show-orders',
                'create-orders',
                'update-orders',
                'delete-orders',
            ]
        ];




        $permissions = [
            $userPermissions,
            $rolePermissions,
            $warehousePermissions,
            $cityPermissions,
            $areaPermissions,
            $classificationPermissions,
            $doctorPermissions,
            $representativePermissions,
            $specializationPermissions,
            $filePermissions,
            $productPermissions,
            $representativeStorePermissions,
            $invoicesPermissions,
            $invoiceItemsPermissions,
            $orderPermissions,
        ];


        foreach ($permissions as $permission) {
            foreach ($permission['permissions'] as $permissionName) {
                Permission::create([
                    'name' => $permissionName,
                    'guard_name' => $permission['guard_name'],
                    'group_name' => $permission['group_name']
                ]);
            }
        }
    }
}
