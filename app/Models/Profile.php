<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
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
     * Get Plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * Permissions not linked with this profile
     */
    public function permissionsAvailable($filters = null)
    {
        $permissions = Permission::whereNotIn('id', function ($query) {
                                    $query->select('permission_profile.permission_id');
                                    $query->from('permission_profile');
                                    $query->where('permission_profile.profile_id', $this->id);
                                })
                                ->where(function ($queryFilter) use ($filters) {
                                    if ($filters)
                                        $queryFilter->where('permissions.name', 'like', '%' . $filters . '%');
                                })
                                ->paginate();

        return $permissions;
    }

    /**
     * Permissions linked with this profile
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
     * Plans not linked with this profile
     */
    public function plansAvailable($filters = null)
    {
        $plans = Plan::whereNotIn('id', function ($query) {
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->where('plan_profile.profile_id', $this->id);
        })
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('plans.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $plans;
    }

    /**
     * PLans linked with this profile
     */
    public function plansAtaccheds($filters = null)
    {
        $plans = $this->plans()
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('plans.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $plans;
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
