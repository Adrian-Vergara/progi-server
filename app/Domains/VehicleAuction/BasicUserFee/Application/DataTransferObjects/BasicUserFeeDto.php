<?php

declare(strict_types=1);

namespace App\Domains\VehicleAuction\BasicUserFee\Application\DataTransferObjects;

final readonly class BasicUserFeeDto
{
    public function __construct(
        public string $id,
        public string $carTypeId,
        public int $percentage,
        public float $minimumValue,
        public float $maximumValue,
    ) {
    }
}
