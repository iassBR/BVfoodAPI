<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTenant(TenantFormRequest $request)
    {
        // if (!$request->token_company) {
        //     return response()->json(['message' => 'Token not found'], 404);
        // }

        $categories = $this->categoryService->getCategoriesByUuid($request->token_company);

        return CategoryResource::collection($categories);
    }
}
