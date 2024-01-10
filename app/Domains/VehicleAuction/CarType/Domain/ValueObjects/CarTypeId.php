<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Domain\ValueObjects;

use App\Domains\Common\Domain\ValueObjects\UuidTrait;

final readonly class CarTypeId
{
    use UuidTrait;
}
