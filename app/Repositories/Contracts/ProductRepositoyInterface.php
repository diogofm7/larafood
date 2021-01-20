<?php


namespace App\Repositories\Contracts;


interface ProductRepositoyInterface
{

    public function getProductsByTenantId(int $idTenant, array $categories);
    public function getProductsByFlag(string $flag);

}
