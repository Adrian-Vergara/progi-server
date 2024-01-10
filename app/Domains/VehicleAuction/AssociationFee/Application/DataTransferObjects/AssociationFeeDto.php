<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AssociationFee\Application\DataTransferObjects;

use App\Domains\Common\Domain\ValueObjects\Money;

final readonly class AssociationFeeDto
{
    public function __construct(
        public string $id,
        public Money $from,
        public ?Money $to,
        public Money $value,
    ) {
    }
}
