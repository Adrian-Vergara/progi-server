<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\DataTransferObjects;

final readonly class ModifyCarTypeDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
