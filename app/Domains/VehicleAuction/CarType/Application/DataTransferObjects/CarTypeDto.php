<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\DataTransferObjects;

final readonly class CarTypeDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
