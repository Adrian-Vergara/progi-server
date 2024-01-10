<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\FixedStorageFee\Application\DataTransferObjects;

use App\Domains\Common\Domain\ValueObjects\Money;

final readonly class FixedStorageFeeDto
{
    public function __construct(
        public string $id,
        public Money $amount,
    ) {
    }
}
