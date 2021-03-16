<?php


namespace App\Services;


use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService
{

    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        $categories = $this->categoryRepository->getCategoriesByTenantId($tenant->id);

        return $categories;
    }

    public function getCategoryByUuid(string $identify)
    {
        return $this->categoryRepository->getCategoryByUuid($identify);
    }

}
