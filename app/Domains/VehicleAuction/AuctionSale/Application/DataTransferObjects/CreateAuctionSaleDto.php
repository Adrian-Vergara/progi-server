<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Application\DataTransferObjects;

use App\Domains\Common\Domain\ValueObjects\Money;

final readonly class CreateAuctionSaleDto
{
    public function __construct(
        public string $id,
        public string $carTypeId,
        public Money $price,
    ) {
    }
}
