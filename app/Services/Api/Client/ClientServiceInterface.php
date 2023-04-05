<?php

namespace App\Services\Api\Client;

interface ClientServiceInterface
{

    public function verifyRegistrationLink($request): array;
    public function storeClient(array $data): ?object;
}
