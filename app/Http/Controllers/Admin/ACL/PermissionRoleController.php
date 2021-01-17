<?php

namespace App\Http\Controllers\admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    private $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:Roles']);
    }

    public function permissions(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole))
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $role->permissionsAtaccheds($request->filter);

        return view('admin.pages.roles.permissions.permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    public function roles(Request $request, $idPermission)
    {
        if (!$permission = $this->permission->find($idPermission))
            return redirect()->back();

        $filters = $request->except('_token');

        $roles = $permission->rolesAtaccheds($request->filter);

        return view('admin.pages.permissions.roles.roles', [
            'roles' => $roles,
            'permission' => $permission,
            'filters' => $filters
        ]);
    }

    public function permissionsAvailable(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole))
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', [
            'role' => $role,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    public function permissionsAttach(Request $request, $idRole)
    {
        if ((!$role = $this->role->find($idRole)) || (!$request->permissions))
            return redirect()->back();

        $role->permissions()->attach($request->permissions);

        return redirect()->route('admin.roles.permissions', $role->id);
    }

    public function permissionsDetach($idRole, $idPermission)
    {
        $role = $this->role->with('permissions')->find($idRole);
        $permission = $role->permissions->find($idPermission);


        if (!$role || !$permission)
            return redirect()->back();

        $role->permissions()->detach($permission);

        return redirect()->back();
    }
}
