<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{

    /**
     * @var TableService
     */
    private $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function show(TenantFormRequest $request, string $identify)
    {
        if (!$table = $this->tableService->getTablesByIdentify($identify))
            return response()->json(['message' => 'not Found'], 404);

        return new TableResource($table);
    }

    public function tablesByTenant(TenantFormRequest $request)
    {
        return TableResource::collection(
            $this->tableService->getTablesByTenantUuid($request->token_company)
        );
    }
}
