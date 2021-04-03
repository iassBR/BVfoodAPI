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
        string $comment,  
        $clientId = '',
        $tableId = ''
    ) {
        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenantId,
            'comment' => $comment,
        ];

        if($clientId) $data['client_id'] = $clientId;

        if($tableId) $data['table_id'] = $tableId;

        $order = $this->order->create($data);

        return $order;
    }

    public function getOrderByIdentify($identify)
    {
    }
}
