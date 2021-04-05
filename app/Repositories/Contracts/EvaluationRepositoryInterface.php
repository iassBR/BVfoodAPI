<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function storeNewEvaluationOrder(int $idOrder, int $idClient, array $data);

    public function getEvaluationsByOrder(int $idClient);

    public function getEvaluationsByClient(int $idClient);

    public function getEvaluationsById(int $id);

    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient);
}
