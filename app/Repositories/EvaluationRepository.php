<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $evaluation;

    public function __construct(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function storeNewEvaluationOrder(int $idOrder, int $idClient, array $data)
    {
        $data = [
            'client_id' => $idClient,
            'order_id' => $idOrder,
            'stars' => $data['stars'],
            'comment' => isset($data['comment']) ? $data['comment'] : '' ,
        ];

        return $this->evaluation->create($data);
    }

    public function getEvaluationsByClient(int $idClient)
    {
        return $this->evaluation->where('client_id', $idClient)->get();
    }

    public function getEvaluationsByOrder(int $idOrder)
    {
        return $this->evaluation->where('order_id', $idOrder)->get();
    }

    public function getEvaluationsById(int $id)
    {
        return $this->evaluation->find($id);
    }

    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient)
    {
        return $this->evaluation->where('client_id', $idClient)
                                ->where('order_id', $idOrder)                        
                                ->first();
    }
}
