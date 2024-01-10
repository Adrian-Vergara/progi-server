<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Domain\Entities;

use App\Domains\Common\Domain\ValueObjects\Money;
use App\Domains\VehicleAuction\AuctionSale\Domain\ValueObjects\AuctionSaleId;
use App\Domains\VehicleAuction\CarType\Domain\ValueObjects\CarTypeId;

final readonly class AuctionSale
{
    private Money $total;

    public function __construct(
        private AuctionSaleId $id,
        private CarTypeId $carTypeId,
        private Money $price,
        private Money $basicUserFee,
        private Money $sellerSpecialFee,
        private Money $associationFee,
        private Money $fixedStorageFee,
    ) {
        $this->total = $this->price->sum(
            $this->basicUserFee,
            $this->sellerSpecialFee,
            $this->associationFee,
            $this->fixedStorageFee,
        );
    }

    public function getId(): AuctionSaleId
    {
        return $this->id;
    }

    public function getCarTypeId(): CarTypeId
    {
        return $this->carTypeId;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getBasicUserFee(): Money
    {
        return $this->basicUserFee;
    }

    public function getSellerSpecialFee(): Money
    {
        return $this->sellerSpecialFee;
    }

    public function getAssociationFee(): Money
    {
        return $this->associationFee;
    }

    public function getFixedStorageFee(): Money
    {
        return $this->fixedStorageFee;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }
}
