<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantService
{
    private $plan, $data = [];
    /**
     * @var TenantRepositoryInterface
     */
    private $repository;

    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenant(int $per_page)
    {
        return $this->repository->getAllTenant($per_page);
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->repository->getTenantByUuid($uuid);
    }

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();

        return $this->storeUser($tenant);
    }

    public function storeTenant()
    {
        $data = $this->data;

        return $this->plan->tenants()->create([
            'cnpj' => $data['cnpj'],
            'name' => $data['empresa'],
            'email' => $data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7)
        ]);
    }

    public function storeUser($tenant)
    {
        $data = $this->data;

        return $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

}
