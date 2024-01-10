<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

final class CalculateTotalPriceOfCarTypeRequest extends Data
{
    public function __construct(
        #[Uuid]
        public readonly string $id,
        #[GreaterThan('0')]
        public readonly float $price,
    ) {
    }
}
