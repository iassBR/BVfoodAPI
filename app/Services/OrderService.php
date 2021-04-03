<?php

namespace App\Services;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\TableRepository;
use App\Repositories\TenantRepository;
use Illuminate\Http\Request;

class OrderService
{

    protected $orderRepository, $tenantRepository, $tableRepository;

    public function __construct(
        OrderRepository $orderRepository,
        TenantRepository $tenantRepository,
        TableRepository $tableRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }



    public function storeNewOrder(array $order)
    {
        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalValueOrder([]);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $comment = isset($order['comment'])  ? $order['comment'] : '';
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');

       return $this->orderRepository->storeNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        
    }

    private function getIdentifyOrder(int $qtyCaraceters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        // $specialCharacters = str_shuffle('!@#$%*-');

        // $characters = $smallLetters.$numbers.$specialCharacters;
        $characters = $smallLetters . $numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaraceters);

        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCaraceters + 1);
        }

        return $identify;
    }

    private function getTotalValueOrder(array $products): float
    {
        return (float) 90;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenant($uuid);

        return $tenant->id;
    }


    private function getTableIdByOrder(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);
            return $table->id;
        }

        return '';
    }

    private function getClientIdByOrder()
    {
        return  auth()->check() ? auth()->user()->id : '';
    }
}
