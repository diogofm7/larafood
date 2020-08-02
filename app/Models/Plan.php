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

    public function search($filter = null)
    {
        $results = $this->where('name', 'like', '%' . $filter . '%')
                        ->orWhere('description', 'like', '%' . $filter . '%')
                        ->latest()
                        ->paginate();

        return $results;
    }
}