<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function storeNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $clientId = '',
        $tableId = ''
    );

    public function getOrderByIdentify(int $identify);


}
