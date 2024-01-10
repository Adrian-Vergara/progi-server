<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\AuctionSale\Presentation\Http\Requests;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\GreaterThan;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapInputName(SnakeCaseMapper::class),
]
class CreateAuctionSaleRequest extends Data
{
    public function __construct(
        #[Uuid]
        public readonly string $carTypeId,
        #[GreaterThan('0')]
        public readonly float $price,
    ) {
    }
}
