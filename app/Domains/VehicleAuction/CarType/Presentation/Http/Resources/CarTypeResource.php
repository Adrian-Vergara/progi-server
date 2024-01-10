<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Resources;

use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeDto;

final readonly class CarTypeResource
{
    public function toArray(CarTypeDto $dto): array
    {
        return [
            ...$dto->toArray(),
        ];
    }
}
