<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\Actions;

use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\ModifyCarTypeDto;
use App\Domains\VehicleAuction\CarType\Domain\Entities\CarType;
use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeEntityRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Domain\ValueObjects\CarTypeId;
use App\Domains\VehicleAuction\CarType\Domain\ValueObjects\CarTypeName;

final readonly class CreateCarTypeAction
{
    public function __construct(
        private CarTypeEntityRepositoryInterface $repository,
    ) {
    }

    public function execute(ModifyCarTypeDto $dto): void
    {
        $carType = new CarType(
            id: CarTypeId::fromId($dto->id),
            name: CarTypeName::fromString($dto->name),
        );

        $this->repository->save(carType: $carType);
    }
}
