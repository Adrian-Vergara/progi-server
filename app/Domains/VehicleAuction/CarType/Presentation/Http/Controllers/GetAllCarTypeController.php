<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Controllers;

use App\Domains\VehicleAuction\CarType\Application\Queries\GetAllCarTypeQuery;
use App\Domains\VehicleAuction\CarType\Presentation\Http\Resources\CarTypeResource;
use Illuminate\Http\JsonResponse;

final readonly class GetAllCarTypeController
{
    public function __construct(
        private GetAllCarTypeQuery $query,
        private CarTypeResource $resource,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->query
                ->execute()
                ->map($this->resource->toArray(...)),
        ]);
    }
}
