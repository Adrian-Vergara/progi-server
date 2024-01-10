<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\CarType\Presentation\Http\Resources;

use App\Domains\VehicleAuction\CarType\Application\DataTransferObjects\CalculatedAmountsDto;
use OpenApi\Attributes as OA;

/**
 * 'car_type' => $this->carType->toArray(),
 * 'price' => $this->price->value(),
 * 'basic_user_fee' => $this->basicUserFee->value(),
 * 'seller_special_fee' => $this->sellerSpecialFee->value(),
 * 'association_fee' => $this->associationFee->value(),
 * 'fixed_storage_fee' => $this->fixedStorageFee->value(),
 * 'total' => $this->total->value(),
 */

#[OA\Schema(
    schema: 'CalculatedAmountsResource',
    properties: [
        new OA\Property(
            property: 'car_type',
            properties: [
                new OA\Property(property: 'id', type: 'string'),
                new OA\Property(property: 'name', type: 'string'),
            ],
            type: 'object',
        ),
        new OA\Property(property: 'price', type: 'float'),
        new OA\Property(property: 'basic_user_fee', type: 'float'),
        new OA\Property(property: 'seller_special_fee', type: 'float'),
        new OA\Property(property: 'association_fee', type: 'float'),
        new OA\Property(property: 'fixed_storage_fee', type: 'float'),
        new OA\Property(property: 'total', type: 'float'),
    ],
    type: 'object',
)]
final readonly class CalculatedAmountsResource
{
    public function toArray(CalculatedAmountsDto $dto): array
    {
        return [
            ...$dto->toArrayInSnakeCase(),
        ];
    }
}
