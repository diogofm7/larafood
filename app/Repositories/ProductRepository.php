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

    public function productsByTenantId(int $idTenant)
    {
        return DB::table($this->table)
                ->where('tenant_id', $idTenant)
                ->get();
    }
}
