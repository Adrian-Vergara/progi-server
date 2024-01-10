<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Application\Queries;

use App\Domains\VehicleAuction\AuctionSale\Domain\Repositories\AuctionSaleDtoRepositoryInterface;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculatedAmountsDto;
use Illuminate\Support\Collection;

final readonly class GetAllAuctionSaleQuery
{
    public function __construct(
        private AuctionSaleDtoRepositoryInterface $repository,
    ) {
    }

    /**  @return Collection<int,CalculatedAmountsDto> */
    public function execute(): Collection
    {
        return $this->repository->getAll();
    }
}
