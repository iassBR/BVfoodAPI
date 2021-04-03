<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function storeNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment,
        $clientId = '',
        $tableId = ''
    );

    public function getOrderByIdentify(string $identify);

    public function registerProductsOrder(int $orderId, array $products);


}
