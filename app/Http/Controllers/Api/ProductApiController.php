<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {
        return ProductResource::collection(
            $this->productService->getProductsByTenantUuid(
                $request->token_company,
                $request->get('categories', [])
            )
        );
    }

    public function show(TenantFormRequest $request, string $identify)
    {
        if (!$product = $this->productService->getProductsByUuid($identify))
            return response()->json(['message' => 'Not Found'], 404);

        return new ProductResource($product);
    }

}
