<?php


namespace App\Repositories\Contracts;


interface ProductRepositoyInterface
{

    public function productsByTenantId(int $idTenant);

}
