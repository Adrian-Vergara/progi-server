<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Infrastructure\Repositories;

use App\Domains\VehicleAuction\CarType\Domain\Entities\CarType;
use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeEntityRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Infrastructure\Models\CarTypeModel;

final readonly class CarTypeEntityRepository implements CarTypeEntityRepositoryInterface
{
    public function save(CarType $carType): void
    {
        /** @var CarTypeModel $carTypeModel */
        $carTypeModel = CarTypeModel::query()
            ->findOrNew($carType->getId()->toString());

        $carTypeModel->id = $carType->getId()->toString();
        $carTypeModel->name = $carType->getName()->value();

        $carTypeModel->save();
    }
}
