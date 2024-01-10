<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CalculateTotalPriceOfCarTypeRequest',
    required: ['price'],
    properties: [
        new OA\Property(
            property: 'price',
            description: 'Vehicle Price',
            type: 'float',
        ),
    ],
    type: 'object'
)]
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
