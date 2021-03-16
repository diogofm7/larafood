<?php


namespace App\Services;


use App\Repositories\Contracts\TableRepositoryInterface;

class TableService
{

    /**
     * @var TableRepositoryInterface
     */
    private $tableRepository;

    public function __construct(TableRepositoryInterface $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function getTablesByUuid(string $identify)
    {
        return $this->tableRepository->getTablesByUuid($identify);
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return $this->tableRepository->getTablesByTenantUuid($uuid);
    }

}
