<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Domain\Repositories;

use App\Domains\VehicleAuction\CarType\Domain\Entities\CarType;

interface CarTypeEntityRepositoryInterface
{
    public function save(CarType $carType): void;
}
