<?php

namespace App\Http\Controllers\admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    private $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:Users']);
    }

    public function roles(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser))
            return redirect()->back();

        $filters = $request->except('_token');

        $roles = $user->rolesAtaccheds($request->filter);

        return view('admin.pages.users.roles.roles', [
            'user' => $user,
            'roles' => $roles,
            'filters' => $filters
        ]);
    }

    public function users(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole))
            return redirect()->back();

        $filters = $request->except('_token');

        $users = $role->usersAtaccheds($request->filter);

        return view('admin.pages.roles.users.users', [
            'users' => $users,
            'role' => $role,
            'filters' => $filters
        ]);
    }

    public function rolesAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser))
            return redirect()->back();

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $roles,
            'filters' => $filters
        ]);
    }

    public function rolesAttach(Request $request, $idUser)
    {
        if ((!$user = $this->user->find($idUser)) || (!$request->roles))
            return redirect()->back();

        $user->roles()->attach($request->roles);

        return redirect()->route('admin.users.roles', $user->id);
    }

    public function rolesDetach($idUser, $idRole)
    {
        $user = $this->user->with('roles')->find($idUser);
        $role = $user->roles->find($idRole);


        if (!$user || !$role)
            return redirect()->back();

        $user->roles()->detach($role);

        return redirect()->back();
    }
}
