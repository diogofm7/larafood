<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Permissions not linked with this role
     */
    public function permissionsAvailable($filters = null)
    {
        $permissions = Permission::whereNotIn('id', function ($query) {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->where('permission_role.role_id', $this->id);
        })
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('permissions.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $permissions;
    }

    /**
     * Permissions linked with this role
     */
    public function permissionsAtaccheds($filters = null)
    {
        $permissions = $this->permissions()
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('permissions.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $permissions;
    }

    /**
     * @param null $filter
     * @return mixed
     */
    public function search($filter = null)
    {
        $results = $this->where('name', 'like', '%' . $filter . '%')
            ->orWhere('description', 'like', '%' . $filter . '%')
            ->latest()
            ->paginate();

        return $results;
    }
}
