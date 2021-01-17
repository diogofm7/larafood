<?php

namespace App\Models\Traits;

trait UserACLTrait
{

    public function permissions()
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];
        foreach ($permissionsRole as $permissionRole) {
            if (in_array($permissionRole, $permissionsPlan))
                array_push($permissions, $permissionRole);
        }

        return $permissions;
    }

    public function permissionsPlan()
    {
        $profiles = $this->tenant->plan->profiles->load(['permissions']);

        $permissions = [];

        foreach ($profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function permissionsRole()
    {
        $roles = $this->roles->load(['permissions']);

        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function hasPermission(String $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }

}
