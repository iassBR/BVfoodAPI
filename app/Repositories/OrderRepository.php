<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function storeNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $clientId = '',
        $tableId = ''
    ) {
    }

    public function getOrderByIdentify(int $identify)
    {
    }
}
