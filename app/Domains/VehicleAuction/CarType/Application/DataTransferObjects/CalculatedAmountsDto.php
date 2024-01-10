<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\DataTransferObjects;

use App\Domains\Common\Domain\ValueObjects\Money;

final readonly class CalculatedAmountsDto
{
    private Money $total;

    public function __construct(
        public CarTypeDto $carType,
        public Money $price,
        public Money $basicUserFee,
        public Money $sellerSpecialFee,
        public Money $associationFee,
        public Money $fixedStorageFee,
    ) {
        $this->total = $this->price->sum(
            $this->basicUserFee,
            $this->sellerSpecialFee,
            $this->associationFee,
            $this->fixedStorageFee,
        );
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

    public function toArrayInSnakeCase(): array
    {
        return [
            'car_type' => $this->carType->toArray(),
            'price' => $this->price->value(),
            'basic_user_fee' => $this->basicUserFee->value(),
            'seller_special_fee' => $this->sellerSpecialFee->value(),
            'association_fee' => $this->associationFee->value(),
            'fixed_storage_fee' => $this->fixedStorageFee->value(),
            'total' => $this->total->value(),
        ];
    }
}
