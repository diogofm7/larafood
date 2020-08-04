<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'url',
        'price',
        'description'
    ];

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Profiles linked with this plan
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

    public function search($filter = null)
    {
        $results = $this->where('name', 'like', '%' . $filter . '%')
                        ->orWhere('description', 'like', '%' . $filter . '%')
                        ->latest()
                        ->paginate();

        return $results;
    }
}
