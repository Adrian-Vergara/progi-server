<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Application\Actions;

use App\Domains\VehicleAuction\AuctionSale\Application\DataTransferObjects\CreateAuctionSaleDto;
use App\Domains\VehicleAuction\AuctionSale\Domain\Entities\AuctionSale;
use App\Domains\VehicleAuction\AuctionSale\Domain\Repositories\AuctionSaleEntityRepositoryInterface;
use App\Domains\VehicleAuction\AuctionSale\Domain\ValueObjects\AuctionSaleId;
use App\Domains\VehicleAuction\CarType\Application\Actions\CalculateTotalPriceAction;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculateTotalPriceDto;
use App\Domains\VehicleAuction\CarType\Domain\ValueObjects\CarTypeId;

final readonly class CreateSaleAuctionAction
{
    public function __construct(
        private CalculateTotalPriceAction $calculateTotalPriceAction,
        private AuctionSaleEntityRepositoryInterface $repository,
    ) {
    }

    public function execute(CreateAuctionSaleDto $dto): void
    {
        $calculatedValues = $this->calculateTotalPriceAction->execute(
            new CalculateTotalPriceDto(carTypeId: $dto->carTypeId, price: $dto->price)
        );

        $auctionSale = new AuctionSale(
            id: AuctionSaleId::fromId($dto->id),
            carTypeId: CarTypeId::fromId($dto->carTypeId),
            price: $dto->price,
            basicUserFee: $calculatedValues->basicUserFee,
            sellerSpecialFee: $calculatedValues->sellerSpecialFee,
            associationFee: $calculatedValues->associationFee,
            fixedStorageFee: $calculatedValues->fixedStorageFee,
        );

        $this->repository->save($auctionSale);
    }
}
