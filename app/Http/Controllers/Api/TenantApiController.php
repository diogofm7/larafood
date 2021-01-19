<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantApiController extends Controller
{

    /**
     * @var TenantService
     */
    private $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index(Request $request)
    {
        return TenantResource::collection($this->tenantService
            ->getAllTenant((int) $request->per_page));
    }

    public function show($uuid)
    {
        if (!$tenant = $this->tenantService->getTenantByUuid($uuid))
            return response()->json(['message' => 'not Found'], 404);

        return new TenantResource($tenant);
    }

}
