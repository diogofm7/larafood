<?php

namespace App\Models;

use App\Tenant\Observers\TenantObserver;
use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Category extends Model
{
    use TenantTrait;

    protected $fillable = [
        'name', 'url', 'description'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function productsAtaccheds($filters = null)
    {
        $products = $this->products()
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('products.title', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $products;
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
