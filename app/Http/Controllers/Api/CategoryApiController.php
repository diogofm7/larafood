<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryApiController extends Controller
{

    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTenant(TenantFormRequest $request)
    {
        return CategoryResource::collection(
            $this->categoryService->getCategoriesByUuid($request->token_company)
        );
    }

    public function show(TenantFormRequest $request, $identify)
    {
        if (!$category = $this->categoryService->getCategoryByUuid($identify))
            return response()->json(['message' => 'not Found'], 404);

        return new CategoryResource($category);
    }

}
