<?php

namespace App\Domains\VehicleAuction\CarType\Application\DataTransferObjects;

use App\Domains\VehicleAuction\BasicUserFee\Application\DataTransferObjects\BasicUserFeeDto;
use App\Domains\VehicleAuction\SellerSpecialFee\Application\DataTransferObjects\SellerSpecialFeeDto;

final readonly class CarTypeWithBasicUserAndSellerSpecialFeeDto
{
    public function __construct(
        public string $id,
        public string $name,
        public BasicUserFeeDto $basicUserFee,
        public SellerSpecialFeeDto $sellerSpecialFee,
    ) {
    }
}
