<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Profiles linked with this permission
     */
    public function profilesAtaccheds($filters = null)
    {
        $profiles = $this->profiles()
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('profiles.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $profiles;
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
