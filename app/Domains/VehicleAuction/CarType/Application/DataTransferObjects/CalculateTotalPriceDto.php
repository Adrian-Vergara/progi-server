<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Application\DataTransferObjects;

use App\Domains\Common\Domain\ValueObjects\Money;

final readonly class CalculateTotalPriceDto
{
    public function __construct(
        public string $carTypeId,
        public Money $price,
    ) {
    }
}
