<?php


namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoyInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoyInterface
{

    /**
     * @var string
     */
    private $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductsByTenantId(int $idTenant, array $categories)
    {
        return DB::table($this->table)
                ->join('category_product', 'category_product.product_id', '=', 'products.id')
                ->join('categories', 'category_product.category_id', '=', 'categories.id')
                ->where('products.tenant_id', $idTenant)
                ->where('categories.tenant_id', $idTenant)
                ->when($categories, function ($q) use ($categories) {
                    $q->whereIn('categories.url', $categories);
                })
                ->get();
    }

    public function getProductsByFlag(string $flag)
    {
        return DB::table($this->table)
                ->where('flag', $flag)
                ->first();
    }
}
