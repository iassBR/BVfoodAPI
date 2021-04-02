<?php

namespace App\Services;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\OrderRepository;

class OrderService
{

    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }


    public function storeNewOrder(array $order)
    {
        $this->orderRepository;
    }
}
