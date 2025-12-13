<?php
namespace App\Services;

use Spatie\Permission\Models\Role;
use App\Services\Interfaces\RoleServiceInterface;

class RoleService 
{
    // return all data
    public function getAll()
    {
       $roles= Role::with('permissions')->paginate();
        return $roles;
    }
    // return search data
    public function getSearch(string $search)
    {
        $roles = Role::where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->with('permissions')
            ->paginate();
        return $roles;
    }
    // create data
    public function create(array $data)
    {
                $role = Role::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'guard_name' => config('auth.defaults.guard', 'web'),
        ]);
        $role->syncPermissions($data['permissions'] ?? []);
        return $role;
    }
    // update data
    public function update(Role $role, array $data)
    {
        $role->update([
        'name' => $data['name'],
        'description' => $data['description'],
        ]);
        $role->syncPermissions($data['permissions'] ?? []);
        return $role;
    }
    // delete data
    public function delete(Role $role)
    {
        $role->delete();
        return $role;
    }

}
