<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\Queries;

use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeDto;
use App\Domains\VehicleAuction\CarType\Domain\Repositories\CarTypeDtoRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class GetAllCarTypeQuery
{
    public function __construct(
        private CarTypeDtoRepositoryInterface $repository,
    ) {
    }

    /** @return Collection<int,CarTypeDto> */
    public function execute(): Collection
    {
        return $this->repository->getAll();
    }
}
