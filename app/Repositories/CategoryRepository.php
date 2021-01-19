<?php


namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    private $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
                ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
                ->where('tenents.uuid', $uuid)
                ->select('categories.*')
                ->get();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return DB::table($this->table)
                ->where('tenant_id', $idTenant)
                ->get();
    }

    public function getCategoryByUrl(string $url)
    {
        return DB::table($this->table)
                ->where('url', $url)
                ->first();
    }
}
