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



        $permissions = [$userPermissions, $rolePermissions];


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
