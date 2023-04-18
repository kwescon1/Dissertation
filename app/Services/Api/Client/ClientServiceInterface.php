<?php

namespace App\Services\Api\Client;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface ClientServiceInterface
{

    public function verifyRegistrationLink($request): array;

    public function storeClient(array $data): ?object;

    public function clients(string $facilityId, string $facilityBranchId): ?Collection;

    public function client(string $id, string $facilityId, string $facilityBranchId): ?Model;

    public function destroyClient($id, $facilityId, $facilityBranchId): ?bool;
}
