<?php


namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{

    /**
     * @var string
     */
    private $table;

    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantId(int $idTenant)
    {
        return DB::table($this->table)
                ->where('tenant_id', $idTenant)
                ->get();
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
                ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
                ->where('tenants.uuid', $uuid)
                ->select('tables.*')
                ->get();
    }

    public function getTablesByUuid(string $identify)
    {
        return DB::table($this->table)
                ->where('uuid', $identify)
                ->first();
    }
}
