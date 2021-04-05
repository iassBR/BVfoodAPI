<?php

namespace App\Services;

use App\Repositories\{
    EvaluationRepository,
    OrderRepository
};
use Illuminate\Http\Request;

class EvaluationService
{
    protected $evaluationRepository;

    public function __construct(
        EvaluationRepository $evaluationRepository,
        OrderRepository $orderRepository
    ) {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function storeNewEvaluationOrder(string $identifyOrder, array $data)
    {
        $clientId = $this->getIdClient();

        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->storeNewEvaluationOrder($order->id, $clientId, $data);
    }

    public function getEvaluationsByOrder(int $idClient)
    {
    }

    public function getEvaluationsByClient(int $idClient)
    {
    }

    private function getIdClient()
    {
        return auth()->user()->id;
    }
}
