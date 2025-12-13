<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $this->authorize('view-roles', Role::class);
        $search = $request->input('search');
        $roles=($search)?$this->roleService->getSearch($search):$this->roleService->getAll();
        return view('pages.dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create-roles', Role::class);
        $role = new Role();
        $permissionGroups = Permission::query()->orderBy('group_name')->get()->groupBy('group_name');
        $selectedPermissions = [];
        return view('pages.dashboard.roles.partials.form', compact('role', 'permissionGroups', 'selectedPermissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $this->roleService->create($request->validated());
        return redirect()->route('roles.index')->with('success', __('Role created'));
    }

    public function show(Role $role)
    {
        $this->authorize('show-roles', $role);
        return view('pages.dashboard.roles.partials.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('update-roles', $role);
        $permissionGroups = Permission::query()->orderBy('group_name')->get()->groupBy('group_name');
        $selectedPermissions = $role->permissions()->pluck('name')->toArray();
        return view('pages.dashboard.roles.partials.form', compact('role', 'permissionGroups', 'selectedPermissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->roleService->update($role, $request->validated());
        return redirect()->route('roles.index')->with('success', __('Role updated'));
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete($role);
        return redirect()->route('roles.index')->with('success', __('Role deleted'));
    }
}
