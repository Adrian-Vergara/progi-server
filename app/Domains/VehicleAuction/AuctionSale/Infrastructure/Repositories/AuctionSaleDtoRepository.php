<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Infrastructure\Repositories;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\AuctionSale\Domain\Repositories\AuctionSaleDtoRepositoryInterface;
use App\Domains\VehicleAuction\AuctionSale\Infrastructure\Models\AuctionSaleModel;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculatedAmountsDto;
use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CarTypeDto;
use Illuminate\Support\Collection;

final readonly class AuctionSaleDtoRepository implements AuctionSaleDtoRepositoryInterface
{
    /** @return Collection<int,CalculatedAmountsDto> */
    public function getAll(): Collection
    {
        return AuctionSaleModel::query()
            ->with('carType')
            ->orderByDesc('created_at')
            ->get()
            ->map($this->mapToCalculatedAmountsDto(...));
    }

    private function mapToCalculatedAmountsDto(AuctionSaleModel $auctionSaleModel): CalculatedAmountsDto
    {
        return new CalculatedAmountsDto (
            carType: new CarTypeDto(
                id: $auctionSaleModel->carType->getKey(),
                name: $auctionSaleModel->carType->name,
            ),
            price: Money::fromFloat($auctionSaleModel->price),
            basicUserFee: Money::fromFloat($auctionSaleModel->basic_user_fee),
            sellerSpecialFee: Money::fromFloat($auctionSaleModel->seller_special_fee),
            associationFee: Money::fromFloat($auctionSaleModel->association_fee),
            fixedStorageFee: Money::fromFloat($auctionSaleModel->fixed_storage_fee),
        );
    }
}
