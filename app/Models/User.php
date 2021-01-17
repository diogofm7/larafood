<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tenant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeTenantFilter(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    /**
     *  Tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Roles not linked with this role
     */
    public function rolesAvailable($filters = null)
    {
        $roles = Role::whereNotIn('id', function ($query) {
            $query->select('role_user.role_id');
            $query->from('role_user');
            $query->where('role_user.user_id', $this->id);
        })
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('role.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $roles;
    }

    /**
     * Roles linked with this role
     */
    public function rolesAtaccheds($filters = null)
    {
        $roles = $this->roles()
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('roles.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $roles;
    }

    /**
     * @param null $filter
     * @return mixed
     */
    public function search($filter = null)
    {
        $results = $this->where('name', 'like', '%' . $filter . '%')
            ->orWhere('email', $filter)
            ->latest()
            ->tenantFilter()
            ->paginate();

        return $results;
    }
}
