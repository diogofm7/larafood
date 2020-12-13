<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    private $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

        $this->middleware(['can:Profiles']);
    }

    public function permissions(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAtaccheds($request->filter);

        return view('admin.pages.profiles.permissions.permissions', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    public function profiles(Request $request, $idPermission)
    {
        if (!$permission = $this->permission->find($idPermission))
            return redirect()->back();

        $filters = $request->except('_token');

        $profiles = $permission->profilesAtaccheds($request->filter);

        return view('admin.pages.permissions.profiles.profiles', [
            'profiles' => $profiles,
            'permission' => $permission,
            'filters' => $filters
        ]);
    }

    public function permissionsAvailable(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    public function permissionsAttach(Request $request, $idProfile)
    {
        if ((!$profile = $this->profile->find($idProfile)) || (!$request->permissions))
            return redirect()->back();

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('admin.profiles.permissions', $profile->id);
    }

    public function permissionsDetach($idProfile, $idPermission)
    {
        $profile = $this->profile->with('permissions')->find($idProfile);
        $permission = $profile->permissions->find($idPermission);


        if (!$profile || !$permission)
            return redirect()->back();

        $profile->permissions()->detach($permission);

        return redirect()->back();
    }

}
