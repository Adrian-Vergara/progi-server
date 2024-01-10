<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\SellerSpecialFee\Application\DataTransferObjects;

final readonly class SellerSpecialFeeDto
{
    public function __construct(
        public string $id,
        public string $carTypeId,
        public int $percentage,
    ) {
    }
}
