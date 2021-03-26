<?php

namespace App\Repositories;

use App\Http\Controllers\Api\CategoryController;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return $this->category
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
            ->get();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return $this->category
            ->where('tenant_id', $idTenant)
            ->get();
    }

    public function getCategoryByUuid(string $uuid)
    {
        return $this->category
            ->where('uuid', $uuid)
            ->first();
    }

    public function getCategoryByUrl(string $url)
    {
        return $this->category
            ->where('url', $url)
            ->first();
    }
}
