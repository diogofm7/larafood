<?php


namespace App\Repositories\Contracts;


interface TableRepositoryInterface
{
    public function getTablesByTenantId(int $idTenant);
    public function getTablesByTenantUuid(string $uuid);
    public function getTablesByIdentify(string $identify);
}
