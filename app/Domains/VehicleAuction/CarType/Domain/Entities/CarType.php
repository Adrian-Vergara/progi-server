<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Domain\Entities;

use App\Domains\VehicleAuction\CarType\Domain\ValueObjects\CarTypeId;
use App\Domains\VehicleAuction\CarType\Domain\ValueObjects\CarTypeName;

final class CarType
{
    public function __construct(
        private readonly CarTypeId $id,
        private CarTypeName $name,
    ) {
    }

    public function getId(): CarTypeId
    {
        return $this->id;
    }

    public function getName(): CarTypeName
    {
        return $this->name;
    }

    public function changeName(CarTypeName $name): void
    {
        $this->name = $name;
    }
}
