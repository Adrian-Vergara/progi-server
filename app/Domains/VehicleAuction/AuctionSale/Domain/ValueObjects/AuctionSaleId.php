<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Domain\ValueObjects;

use App\Domains\Common\Domain\ValueObjects\UuidTrait;

final readonly class AuctionSaleId
{
    use UuidTrait;
}
