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

    public function getProductsByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepositoy->productsByTenantId($tenant->id);
    }

}
