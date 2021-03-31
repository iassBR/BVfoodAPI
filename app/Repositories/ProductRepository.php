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

    public function getProductsByTenantId(int $idTenant, array $categories)
    {

        return $this->product
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('products.tenant_id',  $idTenant)
            ->where('categories.tenant_id',  $idTenant)
            ->where(function ($query) use ($categories) {
                if ($categories != [])
                    $query->whereIn('categories.url', $categories);
            })
            ->select('products.*')
            ->get();
    }
}
