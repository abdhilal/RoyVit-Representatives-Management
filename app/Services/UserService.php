<?php
namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Services\Interfaces\UserServiceInterface;

class UserService 
{
    // return all data
        public function getAll()
    {
       $users= User::with('roles')->paginate();
        return $users;
    }
    // return search data
    public function getSearch(string $search)
    {
        $users = User::with('roles')
            ->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate();
        return $users;
    }
    // return count data
    public function getCounts()
    {
        $counts = User::selectRaw("
                    COUNT(*) as total,
                    SUM(is_active = 1) as active,
                    SUM(is_active = 0) as inactive
                    ")->first();
        return $counts;
    }
    // create data
    public function create(array $data)
    {
        $user = User::query()->create($data);
        if (isset($data['roles'])) {
            $roles=Role::whereIn('id', $data['roles'])->pluck('name')->toArray();
            $user->syncRoles($roles);
        }
        return $user;
    }
    // update data
    public function update(User $user, array $data)
    {
        $user->update($data);
        if (isset($data['roles'])) {
            $roles=Role::whereIn('id', $data['roles'])->pluck('name')->toArray();
            $user->syncRoles($roles);
        }
        return $user;
    }
    // delete data
    public function delete(User $user)
    {
        $user->delete();
        return $user;
    }
    // restore data
    public function restore(User $user)
    {
        $user->restore();
        return $user;
    }
    // force delete data
    public function forceDelete(User $user)
    {
        $user->forceDelete();
        return $user;
    }
    // get deleted data
    public function getDeleted()
    {
        return User::query()->onlyTrashed()->with('roles')->paginate();
    }
    // toggel active
    public function toggelActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return $user;
    }
}
