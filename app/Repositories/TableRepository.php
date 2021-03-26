<?php

namespace App\Repositories;

use App\Models\Table;
use App\Repositories\Contracts\TableRepositoryInterface;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return $this->table
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('tables.*')
            ->get();
    }

    public function getTablesByTenantId(int $idTenant)
    {
        return $this->table
            ->where('tenant_id', $idTenant)
            ->get();
    }

    public function getTableByUuid(string $uuid)
    {
        return $this->table
            ->where('uuid', $uuid)
            ->first();
    }

    public function getTableByIdentify(string $identify)
    {
        return $this->table
            ->where('identify', $identify)
            ->first();
    }
}
