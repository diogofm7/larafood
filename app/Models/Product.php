<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = [
        'title', 'flag', 'price', 'description', 'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function categoriesAvailable($filters = null)
    {
        $categories = Category::whereNotIn('id', function ($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->where('category_product.product_id', $this->id);
        })
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('categories.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $categories;
    }

    public function categoriesAtaccheds($filters = null)
    {
        $categories = $this->categories()
            ->where(function ($queryFilter) use ($filters) {
                if ($filters)
                    $queryFilter->where('categories.name', 'like', '%' . $filters . '%');
            })
            ->paginate();

        return $categories;
    }

    public function search($filter = null)
    {
        $results = $this->where('title', 'like', '%' . $filter . '%')
            ->orWhere('description', 'like', '%' . $filter . '%')
            ->latest()
            ->paginate();

        return $results;
    }
}
