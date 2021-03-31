<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function storeNewClient(array $data);
    public function getClient(int $idClient);
}
