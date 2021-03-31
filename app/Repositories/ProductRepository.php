<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductsByTenantId(int $idTenant)
    {
        return $this->product
            ->where('tenant_id',  $idTenant)
            ->get();
    }
}
