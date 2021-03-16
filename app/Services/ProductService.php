<?php


namespace App\Services;


use App\Repositories\Contracts\ProductRepositoyInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{

    /**
     * @var ProductRepositoyInterface
     */
    private $productRepositoy;
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;

    public function __construct(
        ProductRepositoyInterface $productRepositoy,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->productRepositoy = $productRepositoy;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepositoy->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductsByUuid(string $identify)
    {
        return $this->productRepositoy->getProductsByUuid($identify);
    }

}
